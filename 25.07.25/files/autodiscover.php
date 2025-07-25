<?php
/***********************************************
* File      :   autodiscover.php (Unified)
* Project   :   Z-Push + Outlook IMAP/SMTP support
* Descr     :   Autodiscover service for both MobileSync & Outlook.
* Supports  :   Toggleable login for Outlook via OUTLOOK_REQUIRE_AUTH.
************************************************/

require_once '../vendor/autoload.php';
require_once 'config.php';

/**
 * Config toggle:
 * - true  = Outlook Autodiscover yêu cầu login (Basic Auth, backend verify).
 * - false = Outlook không yêu cầu login (public IMAP/SMTP settings).
 */
define('OUTLOOK_REQUIRE_AUTH', true);

class UnifiedAutodiscover {
    const SCHEMA_MOBILESYNC = 'http://schemas.microsoft.com/exchange/autodiscover/mobilesync/responseschema/2006';
    const SCHEMA_OUTLOOK    = 'http://schemas.microsoft.com/exchange/autodiscover/outlook/responseschema/2006a';
    const MAXINPUTSIZE      = 8192; // Bytes

    private static $instance;

    public static function Start() {
        self::CheckConfig();
        ZLog::Write(LOGLEVEL_DEBUG, '-------- Start UnifiedAutodiscover');

        if (!isset(self::$instance)) {
            self::$instance = new UnifiedAutodiscover();
        }

        if (stripos($_SERVER["REQUEST_METHOD"], "GET") !== false) {
            ZLog::Write(LOGLEVEL_INFO, "GET not supported for autodiscover");
            http_response_code(405);
            ZPush::PrintZPushLegal('GET not supported');
            exit(1);
        }

        self::$instance->HandleRequest();
        ZLog::Write(LOGLEVEL_DEBUG, '-------- End UnifiedAutodiscover');
    }

    private function HandleRequest() {
        $incomingXml = $this->getIncomingXml();
        $schema = (string)$incomingXml->Request->AcceptableResponseSchema;

        if (strcasecmp($schema, self::SCHEMA_MOBILESYNC) === 0) {
            $this->HandleMobileSync($incomingXml);
        }
        elseif (strcasecmp($schema, self::SCHEMA_OUTLOOK) === 0) {
            $this->HandleOutlook($incomingXml);
        }
        else {
            $this->SendErrorResponse("600", "Invalid Request");
        }
    }

    /**
     * Handle MobileSync using full Z-Push backend (login required)
     */
    private function HandleMobileSync($incomingXml) {
        try {
            $backend = ZPush::GetBackend();
            $username = $this->login($backend, $incomingXml);
            $userDetails = $backend->GetUserDetails($username);
            $email = $userDetails['emailaddress'] ?? $incomingXml->Request->EMailAddress;
            $fullname = $userDetails['fullname'] ?? $email;
            $response = $this->createMobileSyncResponse($email, $fullname);
        } catch (Exception $ex) {
            $this->HandleException($ex, $incomingXml ?? null);
            return;
        }
        $this->sendResponse($response);
    }

    /**
     * Handle Outlook Autodiscover (IMAP/SMTP)
     */
    private function HandleOutlook($incomingXml) {
        $email = (string)$incomingXml->Request->EMailAddress;
        $imapServer = parse_url(ZIMBRA_URL)['host'] ?? $_SERVER['SERVER_NAME'];
        $smtpServer = $imapServer;

        if (OUTLOOK_REQUIRE_AUTH) {
            try {
                $backend = ZPush::GetBackend();
                $username = $this->login($backend, $incomingXml);
                $userDetails = $backend->GetUserDetails($username);
                $email = $userDetails['emailaddress'] ?? $email;

                // Nếu backend trả thông tin server
                if (!empty($userDetails['imapserver'])) $imapServer = $userDetails['imapserver'];
                if (!empty($userDetails['smtpserver'])) $smtpServer = $userDetails['smtpserver'];
            } catch (Exception $ex) {
                $this->HandleException($ex, $incomingXml ?? null);
                return;
            }
        }

        // Cấu hình IMAP/SMTP (có thể lấy từ backend hoặc default)
        $imapPort = 993;
        $smtpPort = 465;
        header('Content-Type: text/xml; charset=utf-8');
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        ?>
<Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006">
    <Response xmlns="<?= self::SCHEMA_OUTLOOK ?>">
        <Account>
            <AccountType>email</AccountType>
            <Action>settings</Action>
            <Protocol>
                <Type>IMAP</Type>
                <Server><?= $imapServer ?></Server>
                <Port><?= $imapPort ?></Port>
                <LoginName><?= $email ?></LoginName>
                <SSL>on</SSL>
                <SPA>off</SPA>
                <AuthRequired>on</AuthRequired>
            </Protocol>
            <Protocol>
                <Type>SMTP</Type>
                <Server><?= $smtpServer ?></Server>
                <Port><?= $smtpPort ?></Port>
                <LoginName><?= $email ?></LoginName>
                <SSL>on</SSL>
                <SPA>off</SPA>
                <AuthRequired>on</AuthRequired>
            </Protocol>
        </Account>
    </Response>
</Autodiscover>
<?php
    }

    /**
     * Send error XML response
     */
    private function SendErrorResponse($code, $message) {
        header('Content-Type: text/xml; charset=utf-8');
        list($usec, $sec) = explode(' ', microtime());
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        ?>
<Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006">
    <Response>
        <Error Time="<?=date('H:i:s', $sec) . substr($usec, 0, strlen($usec) - 2)?>" Id="<?=rand(1000000,9999999)?>">
            <ErrorCode><?= $code ?></ErrorCode>
            <Message><?= $message ?></Message>
            <DebugData />
        </Error>
    </Response>
</Autodiscover>
<?php
    }

    /**
     * Original Z-Push helper methods (unchanged)
     */
    private function getIncomingXml() {
        if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > self::MAXINPUTSIZE)
            throw new ZPushException('Request too large.');

        $input = @file_get_contents('php://input', NULL, NULL, 0, self::MAXINPUTSIZE);
        $xml = simplexml_load_string($input);
        if (!isset($xml->Request->EMailAddress) || !isset($xml->Request->AcceptableResponseSchema))
            throw new FatalException('Invalid input XML');

        return $xml;
    }

    private function login($backend, $incomingXml) {
        if (!isset($_SERVER['PHP_AUTH_PW']))
            throw new AuthenticationRequiredException("Access denied. No password.");
        $username = USE_FULLEMAIL_FOR_LOGIN ? $incomingXml->Request->EMailAddress
                                            : Utils::GetLocalPartFromEmail($incomingXml->Request->EMailAddress);
        $username = Utils::ConvertAuthorizationToUTF8($username);
        $password = Utils::ConvertAuthorizationToUTF8($_SERVER['PHP_AUTH_PW']);
        if (!$backend->Logon($username, "", $password))
            throw new AuthenticationRequiredException("Access denied. Username or password incorrect.");
        return $username;
    }

    private function createMobileSyncResponse($email, $fullname) {
        $xml = file_get_contents('response.xml');
        $zpushHost = defined('ZPUSH_HOST') ? ZPUSH_HOST : ($_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME']);
        $serverUrl = "https://" . $zpushHost . "/Microsoft-Server-ActiveSync";
        $response = new SimpleXMLElement($xml);
        $response->Response->User->DisplayName = $fullname;
        $response->Response->User->EMailAddress = $email;
        $response->Response->Action->Settings->Server->Url = $serverUrl;
        $response->Response->Action->Settings->Server->Name = $serverUrl;
        return $response->asXML();
    }

    private function sendResponse($response) {
        header("Content-Type: text/xml; charset=utf-8");
        echo $response;
    }

    private function HandleException($ex, $incomingXml) {
        if ($ex instanceof AuthenticationRequiredException) {
            http_response_code(401);
            header('WWW-Authenticate: Basic realm="ZPush"');
        } else {
            http_response_code(500);
        }
    }

    public static function CheckConfig() {
        if (!defined('REAL_BASE_PATH')) {
            define('REAL_BASE_PATH', str_replace('autodiscover/', '', BASE_PATH));
        }
        set_include_path(get_include_path() . PATH_SEPARATOR . REAL_BASE_PATH);
    }
}

UnifiedAutodiscover::Start();
