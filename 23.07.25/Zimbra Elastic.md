# Elastic Zimbra
## Hướng dẫn cài đặt và cấu hình Elastic Stack với Rsyslog để thu thập nhật ký từ Zimbra

Hướng dẫn này sẽ giúp bạn thiết lập hệ thống giám sát nhật ký tập trung bằng cách sử dụng Elastic Stack trên máy chủ Ubuntu 22.04 của bạn. Chúng ta sẽ cấu hình Rsyslog để gửi nhật ký từ máy chủ Zimbra sang Elastic Stack để phân tích và trực quan hóa.

### I. Chuẩn bị máy chủ Elastic (192.168.50.128)

Đây là máy chủ nơi bạn sẽ cài đặt Elasticsearch, Kibana, Logstash và Filebeat.

#### 1\. Cập nhật hostname và file hosts

Mở Terminal trên máy chủ Elastic của bạn và chạy các lệnh sau:

```bash
sudo hostnamectl set-hostname elastic.annt.cloud
sudo nano /etc/hosts
```

Trong file `hosts`, thêm dòng sau và lưu lại (Ctrl+O, Enter, Ctrl+X):

```
192.168.50.128 elastic.annt.cloud
```

#### 2\. Cài đặt Rsyslog và tạo chứng chỉ SSL/TLS

Chúng ta sẽ sử dụng Rsyslog để nhận nhật ký từ Zimbra. Việc tạo chứng chỉ giúp việc truyền dữ liệu được bảo mật.

```bash
sudo apt update
sudo apt install -y rsyslog rsyslog-gnutls gnutls-bin haveged
```

Tạo thư mục cho chứng chỉ và di chuyển vào đó:

```bash
sudo mkdir /etc/rsyslog-certs
cd /etc/rsyslog-certs
```

Tạo các khóa và chứng chỉ:

```bash
sudo certtool --generate-privkey --outfile ca-key.pem
sudo certtool --generate-self-signed --load-privkey ca-key.pem --outfile ca.pem
sudo certtool --generate-privkey --outfile rslclient-key.pem --bits 2048
sudo certtool --generate-request --load-privkey rslclient-key.pem --outfile request.pem
sudo certtool --generate-certificate --load-request request.pem --outfile rslclient-cert.pem --load-ca-certificate ca.pem --load-ca-privkey ca-key.pem
sudo certtool --generate-privkey --outfile rslserver-key.pem --bits 2048
sudo certtool --generate-certificate --load-request request.pem --outfile rslserver-cert.pem --load-ca-certificate ca.pem --load-ca-privkey ca-key.pem
```

Thay đổi quyền sở hữu các file chứng chỉ:

```bash
sudo chown syslog:syslog /etc/rsyslog-certs -R
ls -hal /etc/rsyslog-certs
```

Bạn sẽ thấy danh sách các file chứng chỉ đã được tạo.

#### 3\. Cấu hình Rsyslog trên máy chủ Elastic

Mở file cấu hình Rsyslog:

```bash
sudo nano /etc/rsyslog.conf
```

Xóa toàn bộ nội dung trong file và dán nội dung sau vào. Hãy chắc chắn rằng bạn đã thay đổi `PermittedPeer=["elastic.barrydegraaff.nl"]` thành `PermittedPeer=["192.168.50.120"]` hoặc `PermittedPeer=["<tên_máy_chủ_zimbra_trong_hosts>"]` nếu bạn đã cấu hình tên miền cho Zimbra trong file hosts của máy chủ Elastic. Để đơn giản, ở đây chúng ta sẽ dùng IP của Zimbra.

```conf
module(load="imuxsock")
module(load="imklog" permitnonkernelfacility="on")

# Cấu hình để nhận nhật ký qua TCP với mã hóa TLS
module(load="imtcp"
    StreamDriver.Name="gtls"
    StreamDriver.Mode="1"
    StreamDriver.Authmode="x509/name"
    PermittedPeer=["192.168.50.120"] # Đảm bảo thay thế bằng IP của Zimbra Server
    )

global(
    DefaultNetstreamDriver="gtls"
    DefaultNetstreamDriverCAFile="/etc/rsyslog-certs/ca.pem"
    DefaultNetstreamDriverCertFile="/etc/rsyslog-certs/rslserver-cert.pem"
    DefaultNetstreamDriverKeyFile="/etc/rsyslog-certs/rslserver-key.pem"
    )

input(
    type="imtcp"
    port="514"
    )

$MaxOpenFiles 2048
$ActionFileDefaultTemplate RSYSLOG_TraditionalFileFormat
$RepeatedMsgReduction on
$FileOwner syslog
$FileGroup adm
$FileCreateMode 0640
$DirCreateMode 0755
$Umask 0022
$PrivDropToUser syslog
$PrivDropToGroup syslog
$WorkDirectory /var/spool/rsyslog
$IncludeConfig /etc/rsyslog.d/*.conf
```

Lưu file (Ctrl+O, Enter, Ctrl+X).

Khởi động lại Rsyslog và kiểm tra cổng:

```bash
sudo systemctl restart rsyslog
sudo netstat -tulpn | grep 514
```

Nếu bạn thấy `tcp` lắng nghe trên cổng `514`, điều đó có nghĩa là Rsyslog đã sẵn sàng nhận nhật ký.

#### 4\. Cài đặt Elastic Stack (Elasticsearch, Kibana, Logstash, Filebeat)

##### Cài đặt Java Development Kit (JDK)

Elastic Stack yêu cầu JDK để hoạt động:

```bash
sudo apt install default-jdk -y
```

##### Cài đặt Elasticsearch

Thêm khóa GPG và kho lưu trữ Elastic:

```bash
wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo gpg --dearmor -o /usr/share/keyrings/elasticsearch-keyring.gpg
sudo apt-get install apt-transport-https -y
echo "deb [signed-by=/usr/share/keyrings/elasticsearch-keyring.gpg] https://artifacts.elastic.co/packages/8.x/apt stable main" | sudo tee /etc/apt/sources.list.d/elastic-8.x.list
sudo apt-get update
sudo apt-get install elasticsearch -y
```

Cấu hình Elasticsearch:

```bash
sudo nano /etc/elasticsearch/elasticsearch.yml
```

Tìm và sửa hoặc thêm các dòng sau:

```yml
path.data: /var/lib/elasticsearch
path.logs: /var/log/elasticsearch

network.host: localhost # Giữ nguyên localhost nếu bạn chỉ muốn truy cập từ máy chủ này
xpack.security.enabled: false # Tắt bảo mật để đơn giản trong môi trường thử nghiệm

xpack.security.http.ssl:
  enabled: false

xpack.security.transport.ssl:
  enabled: false

cluster.initial_master_nodes: ["elastic.annt.cloud"] # Đảm bảo tên này khớp với hostname bạn đã đặt
```

Lưu file (Ctrl+O, Enter, Ctrl+X).

Khởi động và bật Elasticsearch:

```bash
sudo systemctl start elasticsearch # Quá trình này có thể mất một lúc
sudo systemctl enable elasticsearch
```

Kiểm tra trạng thái Elasticsearch:

```bash
curl -X GET "localhost:9200"
```

Bạn sẽ thấy thông tin về Elasticsearch nếu nó đang chạy đúng.

##### Cài đặt Kibana

Kibana là giao diện web để trực quan hóa dữ liệu từ Elasticsearch.

```bash
sudo apt install kibana -y
sudo systemctl enable kibana
```

Cấu hình Kibana:

```bash
sudo nano /etc/kibana/kibana.yml
```

Tìm và sửa hoặc thêm các dòng sau:

```yml
server.publicBaseUrl: "https://elastic.annt.cloud/" # Đảm bảo tên này khớp với hostname bạn đã đặt
security.showInsecureClusterWarning: false
```

Lưu file (Ctrl+O, Enter, Ctrl+X).

Khởi động Kibana:

```bash
sudo systemctl start kibana
```

##### Cài đặt Nginx để truy cập Kibana qua HTTPS và xác thực cơ bản

Để bảo vệ Kibana và truy cập qua HTTPS, chúng ta sẽ dùng Nginx làm reverse proxy.

```bash
sudo apt install nginx apache2-utils -y
```

Tạo người dùng và mật khẩu cho Nginx:

```bash
sudo htpasswd -bc /etc/nginx/htpasswd.users admin admin # Thay 'admin' thứ 2 bằng mật khẩu bạn muốn
```

Xóa cấu hình Nginx mặc định và tạo file cấu hình mới:

```bash
sudo rm /etc/nginx/sites-enabled/default
sudo nano /etc/nginx/sites-enabled/default
```

Dán nội dung sau vào file. **Lưu ý:** Phần `ssl_certificate` và `ssl_certificate_key` yêu cầu bạn phải có chứng chỉ SSL cho `elastic.annt.cloud`. Nếu bạn chưa có, bạn có thể bỏ qua phần SSL và chỉ cấu hình HTTP cho đến khi bạn có chứng chỉ. Trong ví dụ này, chúng ta giả định bạn sẽ có chứng chỉ Let's Encrypt hoặc tạo chứng chỉ tự ký.

**Để đơn giản và không cần chứng chỉ SSL ngay lập tức (chỉ dùng HTTP):**

```nginx
# Upstreams
upstream backend {
server 127.0.0.1:5601;
}

# HTTP Server
server {
    listen 80;
    server_name elastic.annt.cloud;

    client_max_body_size 200M;

    error_log /var/log/nginx/elastic.access.log;

    auth_basic "Restricted Access";
    auth_basic_user_file /etc/nginx/htpasswd.users;

    location / {
        proxy_pass http://backend/;

        proxy_http_version 1.1;
        proxy_hide_header 'X-Frame-Options';
        proxy_hide_header 'Access-Control-Allow-Origin';

        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $http_host;

        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forward-Proto http;
        proxy_set_header X-Nginx-Proxy true;

        proxy_redirect off;
    }
}
```

**Nếu bạn muốn dùng HTTPS (cần chứng chỉ SSL):**

Trước khi thực hiện phần này, bạn cần có chứng chỉ SSL tại `/etc/letsencrypt/live/annt.cloud/fullchain.pem` và `/etc/letsencrypt/live/annt.cloud/privkey.pem`. Bạn có thể sử dụng Certbot để lấy chứng chỉ Let's Encrypt hoặc tạo chứng chỉ tự ký.

```nginx
# Upstreams
upstream backend {
server 127.0.0.1:5601;
}

# HTTPS Server
server {
    listen 443 ssl;
    server_name elastic.annt.cloud;

    client_max_body_size 200M;

    error_log /var/log/nginx/elastic.access.log;

    ssl_certificate /etc/letsencrypt/live/annt.cloud/fullchain.pem; # Thay đổi đường dẫn này
    ssl_certificate_key /etc/letsencrypt/live/annt.cloud/privkey.pem; # Thay đổi đường dẫn này

    ssl_session_timeout 1d;
    ssl_session_cache shared:MozSSL:10m;
    ssl_session_tickets off;

    ssl_protocols TLSv1.3;
    ssl_prefer_server_ciphers off;

    add_header Strict-Transport-Security "max-age=63072000" always;

    ssl_stapling on;
    ssl_stapling_verify on;

    auth_basic "Restricted Access";
    auth_basic_user_file /etc/nginx/htpasswd.users;

    location / {
        proxy_pass http://backend/;

        proxy_http_version 1.1;
        proxy_hide_header 'X-Frame-Options';
        proxy_hide_header 'Access-Control-Allow-Origin';

        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $http_host;

        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forward-Proto http;
        proxy_set_header X-Nginx-Proxy true;

        proxy_redirect off;
    }
}
```

Lưu file (Ctrl+O, Enter, Ctrl+X).

Khởi động lại Nginx:

```bash
sudo systemctl restart nginx
```

Bây giờ bạn có thể truy cập Kibana qua trình duyệt bằng địa chỉ `http://elastic.annt.cloud` (hoặc `https://elastic.annt.cloud` nếu bạn cấu hình SSL). Bạn sẽ được yêu cầu nhập tên người dùng (`admin`) và mật khẩu bạn đã đặt.

##### Cài đặt Logstash

Logstash sẽ nhận nhật ký từ Rsyslog và gửi chúng đến Elasticsearch.

```bash
sudo apt install logstash -y
```

Tạo các file cấu hình cho Logstash:

```bash
sudo nano /etc/logstash/conf.d/02-beats-input.conf
```

Dán nội dung sau vào file `02-beats-input.conf`:

```conf
input {
  beats {
    port => 5044
  }
}
```

Lưu file (Ctrl+O, Enter, Ctrl+X).

Tiếp theo, tạo file cấu hình đầu ra:

```bash
sudo nano /etc/logstash/conf.d/30-elasticsearch-output.conf
```

Dán nội dung sau vào file `30-elasticsearch-output.conf`:

```conf
output {
  elasticsearch {
    hosts => ["localhost:9200"]
    manage_template => false
    index => "%{[@metadata][beat]}-%{[@metadata][version]}-%{+YYYY.MM.dd}"
  }
}
```

Lưu file (Ctrl+O, Enter, Ctrl+X).

Bật và khởi động Logstash:

```bash
sudo systemctl start logstash
sudo systemctl enable logstash
```

##### Cài đặt Filebeat

Filebeat sẽ thu thập nhật ký từ Rsyslog và gửi chúng đến Logstash hoặc Elasticsearch.

```bash
sudo apt install filebeat -y
```

Cấu hình Filebeat:

```bash
sudo nano /etc/filebeat/filebeat.yml
```

Tìm và sửa hoặc thêm các dòng sau. Đảm bảo bỏ comment (xóa `#` ở đầu dòng) nếu chúng đã có sẵn.

```yml
filebeat.inputs:
- type: filestream
  id: zimbra-filestream
  pipeline: zimbra # Thêm dòng này để sử dụng pipeline xử lý nhật ký Zimbra
  enabled: true
  paths:
    - /var/log/syslog # Filebeat sẽ đọc nhật ký từ file này

filebeat.config.modules:
  path: ${path.config}/modules.d/*.yml
  reload.enabled: false

setup.template.settings:
  index.number_of_shards: 1

setup.dashboards.enabled: true

setup.kibana:
  host: "localhost:5601" # Hoặc địa chỉ IP của máy chủ Kibana nếu không phải localhost

output.elasticsearch:
  hosts: ["localhost:9200"] # Hoặc địa chỉ IP của máy chủ Elasticsearch nếu không phải localhost

processors:
  - add_host_metadata:
      when.not.contains.tags: forwarded
  - add_cloud_metadata: ~
  - add_docker_metadata: ~
  - add_kubernetes_metadata: ~
```

Lưu file (Ctrl+O, Enter, Ctrl+X).

Thiết lập index cho Filebeat:

```bash
sudo filebeat setup --pipelines
sudo filebeat setup --index-management -E output.logstash.enabled=false -E 'output.elasticsearch.hosts=["localhost:9200"]'
```

Khởi động và bật Filebeat:

```bash
sudo systemctl start filebeat
sudo systemctl enable filebeat
```

### II. Chuẩn bị máy chủ Zimbra (192.168.50.120)

Đây là máy chủ Zimbra nơi nhật ký sẽ được thu thập.
  * **Zimbra 8.8.15**: Được cài đặt và hoạt động. Bạn có thể tham khảo hướng dẫn [Zimbra 8.8.15 on Ubuntu 20.04](./Zimbra%208.8.15%20on%20Ubuntu%2020.04.md).
#### 1\. Cài đặt Rsyslog và sao chép chứng chỉ

```bash
sudo apt update
sudo apt install -y rsyslog rsyslog-gnutls
```

Tạo thư mục chứng chỉ:

```bash
sudo mkdir /etc/rsyslog-certs
```

Sao chép các file chứng chỉ từ máy chủ Elastic sang máy chủ Zimbra. Từ máy chủ Elastic, chạy lệnh này:

```bash
scp /etc/rsyslog-certs/* root@192.168.50.120:/etc/rsyslog-certs/
```

Bạn sẽ cần nhập mật khẩu root của máy chủ Zimbra.

Trên máy chủ Zimbra, thay đổi quyền sở hữu các file chứng chỉ:

```bash
sudo chown syslog:syslog /etc/rsyslog-certs -R
```

#### 2\. Cấu hình Rsyslog trên máy chủ Zimbra

Mở file cấu hình Rsyslog:

```bash
sudo nano /etc/rsyslog.conf
```

Xóa toàn bộ nội dung trong file và dán nội dung sau vào. Đảm bảo thay thế `elastic.annt.cloud` bằng tên miền bạn đã cấu hình trên máy chủ Elastic (nếu bạn không dùng tên miền, có thể thử dùng IP 192.168.50.128, nhưng khuyến nghị dùng tên miền để khớp với cấu hình chứng chỉ).

```conf
module(load="imuxsock")
module(load="imklog" permitnonkernelfacility="on")

$DefaultNetstreamDriver gtls

$DefaultNetstreamDriverCAFile /etc/rsyslog-certs/ca.pem
$DefaultNetstreamDriverCertFile /etc/rsyslog-certs/rslclient-cert.pem
$DefaultNetstreamDriverKeyFile /etc/rsyslog-certs/rslclient-key.pem

$ActionSendStreamDriverPermittedPeer elastic.annt.cloud # Đảm bảo tên này khớp với hostname của máy chủ Elastic
$ActionSendStreamDriverMode 1
$ActionSendStreamDriverAuthMode x509/name

# Chuyển tiếp tất cả nhật ký hệ thống đến máy chủ Elastic
*.* @@(o)elastic.annt.cloud:514 # Đảm bảo tên này khớp với hostname của máy chủ Elastic

$ActionFileDefaultTemplate RSYSLOG_TraditionalFileFormat
$RepeatedMsgReduction on
$FileOwner syslog
$FileGroup adm
$FileCreateMode 0640
$DirCreateMode 0755
$Umask 0022
$PrivDropToUser syslog
$PrivDropToGroup syslog
$WorkDirectory /var/spool/rsyslog

$ModLoad imfile

# Cấu hình để đọc các file nhật ký của Zimbra
# error log
$InputFileName /opt/zimbra/log/nginx.error.log
$InputFileTag nginx-error:
$InputFileStateFile stat-nginx-error
$InputFileSeverity info
$InputFileFacility local6
$InputFilePollInterval 1
$InputRunFileMonitor

# access log
$InputFileName /opt/zimbra/log/nginx.access.log
$InputFileTag nginx-access:
$InputFileStateFile stat-nginx-access
$InputFileSeverity info
$InputFileFacility local6
$InputFilePollInterval 1
$InputRunFileMonitor

# audit log
$InputFileName /opt/zimbra/log/audit.log
$InputFileTag zimbra-audit:
$InputFileStateFile zimbra-audit
$InputFileSeverity info
$InputFileFacility local0
$InputFilePollInterval 1
$InputRunFileMonitor

$IncludeConfig /etc/rsyslog.d/*.conf
```

Lưu file (Ctrl+O, Enter, Ctrl+X).

#### 3\. Cấp quyền cho Rsyslog đọc nhật ký Zimbra

Để Rsyslog có thể đọc các file nhật ký của Zimbra, bạn cần thêm người dùng `syslog` vào nhóm `zimbra`:

```bash
sudo usermod -a -G zimbra syslog
```

#### 4\. Khởi động lại Rsyslog và cấu hình Zimbra

```bash
sudo systemctl restart rsyslog
```

Sau đó, cấu hình Zimbra để đẩy nhật ký sang Rsyslog và khởi động lại dịch vụ Zimbra. Thực hiện các lệnh này với quyền `zimbra` user:

```bash
su zimbra
zmprov mcf zimbraLogToSysLog TRUE
zmcontrol restart
```

Bây giờ, một số nhật ký của Zimbra sẽ bắt đầu được đẩy qua Rsyslog và đến máy chủ Elastic của bạn.

### III. Cấu hình Ingest Pipeline trong Kibana

Ingest Pipeline giúp bạn xử lý và chuẩn hóa dữ liệu nhật ký trước khi lưu trữ vào Elasticsearch.

1.  Mở trình duyệt và truy cập vào **Kibana** (ví dụ: `http://elastic.annt.cloud` hoặc `https://elastic.annt.cloud`). Đăng nhập bằng tài khoản Nginx đã tạo.

2.  Trong Kibana, điều hướng đến **Stack Management** (Quản lý ngăn xếp) \> **Ingest Pipelines** (Đường dẫn nhập).

3.  Nhấp vào **Create Pipeline** (Tạo đường dẫn).

4.  Đặt tên cho pipeline là `zimbra`.

5.  Trong phần **Processors** (Bộ xử lý), nhấp vào **Add a processor** (Thêm bộ xử lý).

6.  Chọn **Grok** làm loại bộ xử lý.

7.  Điền các thông tin sau:

      * **Field:** `message`
      * **Patterns:** `zmstat cpu.csv:.*:: %{DATA:statdate} %{DATA:stattime}, %{NUMBER:cpu-user:float}, %{NUMBER:cpu-nice:float}, %{NUMBER:cpu-sys:float}, %{NUMBER:cpu-idle:float}, %{NUMBER:cpu-iowait:float}, %{NUMBER:cpu-irq:float}, %{NUMBER:cpu-soft-irq:float}`
      * **Ignore missing:** Chọn (tích vào ô này)
      * **Condition:** `ctx.message.contains('zmstat cpu.csv')`
      * **Tag:** `cpucsv`
      * **Ignore failure:** Chọn (tích vào ô này)

8.  Nhấp vào **Add** (Thêm).

9.  Nhấp vào **Save Pipeline** (Lưu đường dẫn).

#### Kiểm tra lại và khởi động lại dịch vụ

Sau khi cấu hình Ingest Pipeline và Filebeat, bạn nên khởi động lại Filebeat và Logstash trên máy chủ Elastic để đảm bảo các thay đổi được áp dụng:

```bash
sudo systemctl restart filebeat
sudo systemctl restart logstash
```

### IV. Kiểm tra và sử dụng

Sau khi hoàn thành tất cả các bước trên, nhật ký từ Zimbra sẽ được đẩy sang máy chủ Elastic, được Rsyslog nhận, Logstash xử lý, và Filebeat gửi đến Elasticsearch. Bạn có thể kiểm tra nhật ký trong Kibana:

1.  Trong Kibana, điều hướng đến **Analytics** (Phân tích) \> **Discover** (Khám phá).
2.  Chọn index pattern (mẫu chỉ mục) phù hợp, ví dụ: `filebeat-*`.
3.  Bạn sẽ bắt đầu thấy các nhật ký từ máy chủ Zimbra xuất hiện. Bạn có thể sử dụng các công cụ tìm kiếm và lọc của Kibana để phân tích nhật ký.

-----

**Lưu ý quan trọng:**

  * **Tên miền và IP:** Đảm bảo bạn thay thế `elastic.annt.cloud` bằng tên miền hoặc địa chỉ IP thực tế của máy chủ Elastic của bạn trong các file cấu hình. Tốt nhất là sử dụng tên miền và cấu hình DNS cho nó.
  * **Bảo mật:** Hướng dẫn này tắt một số tính năng bảo mật của Elasticsearch và Kibana để đơn giản hóa quá trình cài đặt. Trong môi trường sản xuất, bạn NÊN bật bảo mật của Elastic Stack (x-pack security) và cấu hình nó một cách cẩn thận.
  * **Chứng chỉ SSL:** Đối với Nginx, nếu bạn không có chứng chỉ SSL hợp lệ, trình duyệt của bạn sẽ cảnh báo về kết nối không an toàn. Bạn có thể sử dụng Let's Encrypt với Certbot để có chứng chỉ miễn phí.
  * **Kiểm tra lỗi:** Nếu gặp sự cố, hãy kiểm tra nhật ký của các dịch vụ (`sudo journalctl -xeu rsyslog`, `sudo journalctl -xeu elasticsearch`, `sudo journalctl -xeu kibana`, `sudo journalctl -xeu logstash`, `sudo journalctl -xeu filebeat`) để tìm hiểu nguyên nhân.

