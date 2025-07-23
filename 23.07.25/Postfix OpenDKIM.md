
# [Postfix] Install and Configure DKIM  

##### Replace : anthanh264.site = YOUR-DOMAIN
# Table of contents

- [[Postfix] Install and Configure DKIM](#postfix-install-and-configure-dkim)
  - [Install](#install)
  - [Config](#config)
  - [Run](#run)
  - [Fix](#fix)
  - [References](#references)
## Install 
- Update
```
sudo apt-get update
```
- Install 
```
sudo apt-get install opendkim opendkim-tools
```
## Config 
- Service: `/etc/opendkim.conf`
```
sudo vim /etc/opendkim.conf
```
```
AutoRestart             Yes
AutoRestartRate         10/1h
UMask                   002
Syslog                  yes
SyslogSuccess           Yes
LogWhy                  Yes

Canonicalization        relaxed/simple

ExternalIgnoreList      refile:/etc/opendkim/TrustedHosts
InternalHosts           refile:/etc/opendkim/TrustedHosts
KeyTable                refile:/etc/opendkim/KeyTable
SigningTable            refile:/etc/opendkim/SigningTable

Mode                    sv
PidFile                 /var/run/opendkim/opendkim.pid
SignatureAlgorithm      rsa-sha256

UserID                  opendkim:opendkim

Socket                  inet:12301@localhost
```
- Port DKIM `/etc/default/opendkim`
```
sudo vim /etc/default/opendkim
```
```
SOCKET="inet:12301@localhost"
```

- Link with Postfix `/etc/postfix/main.cf`
    ```
    sudo vim /etc/postfix/main.cf
    ```
     + Add 2 lines
    ```
    milter_protocol = 2
    milter_default_action = accept
    ```
    + Add `inet:localhost:12301` to`smtpd_milters` and`non_smtpd_milters` 
    ```
    smtpd_milters = inet:127.0.0.1:11332, inet:localhost:12301
    non_smtpd_milters = inet:127.0.0.1:11332, inet:localhost:12301
    ```
- Create Folder Config
```
sudo  mkdir /etc/opendkim
```
```
sudo mkdir /etc/opendkim/keys
```

- Config **TrustedHosts** `/etc/opendkim/TrustedHosts`
```
vim /etc/opendkim/TrustedHosts
```
```
127.0.0.1
localhost
192.168.0.1/24

*.anthanh264.site

````

- Create **Key Table** `/etc/opendkim/KeyTable`
```
sudo vim /etc/opendkim/KeyTable
```
```
mail._domainkey.anthanh264.site anthanh264.site:mail:/etc/opendkim/keys/anthanh264.site/mail.private
```
- Create **SigningTable**: `/etc/opendkim/SigningTable`
```
sudo vim /etc/opendkim/SigningTable
```
```
*@anthanh264.site mail._domainkey.anthanh264.site

```


- Create a folder containing the **key** 
```
cd /etc/opendkim/keys
```
```
sudo mkdir anthanh264.site
```
- Generate the public and private keys
    ```
    cd /etc/opendkim/keys/anthanh264.site
    ```
    + Generate Key: Selector = mail, Domain = anthanh264.site
    ```
    sudo opendkim-genkey -s mail -d anthanh264.site
    ```
    + Grant Permission
    ```
    sudo chown opendkim:opendkim mail.private
    ```
- Config DKIM DNS Record
    + Get DNS info
    ```
    sed 's/\"//g' /etc/opendkim/keys/anthanh264.site/mail.txt
    ```
    + Content of Record
    ![](https://i.imgur.com/x8TF7uz.png)
    + DNS Record
    ![](https://i.imgur.com/bmc6508.png)

## Run 
```
sudo service postfix restart
sudo service opendkim restart
```
## Check 
- Sent mail to `check-auth@verifier.port25.com` to get report 
- Result 
![](https://i.imgur.com/DvQbgne.png)

## Fix 
- Error start opendkim
    + Log
    ```
    opendkim.service: Can't open PID file /var/run/opendkim/opendkim.pid (yet?)
    ```
    + Fix 
    ```
    vim /etc/systemd/system/multi-user.target.wants/opendkim.service
    ```
    ```
    [Service]
    PIDFile=/var/run/opendkim/opendkim.pid
    ExecStartPost=/bin/sh -c 'chown opendkim:opendkim 
    /var/run/opendkim/opendkim.pid'
    ```
    ```
    systemctl daemon-reload
    sudo service opendkim restart
    ```

## References
* [How To Install and Configure DKIM with Postfix on Debian Wheezy](https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-dkim-with-postfix-on-debian-wheezy)