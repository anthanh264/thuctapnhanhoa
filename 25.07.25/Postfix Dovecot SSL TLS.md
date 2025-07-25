# TLS/SSL Enable 
# Table of contents
- [TLS/SSL Enable](#tlsssl-enable)
  - [Install Certbot](#install-certbot)
  - [Get Certificate](#get-certificate)
  - [Config SSL/TLS Mail Server](#config-ssltls-mail-server)
  - [Test](#test)
  - [References](#references)

## Install Certbot 
- Cài đặt Snap
```
sudo apt install snapd

```
- Update Snap 
```
sudo snap install core; sudo snap refresh core
```
- Cài đặt certbot
```
sudo snap install --classic certbot
```
- Tạo link đường dẫn khởi chạy certbot 
```
sudo ln -s /snap/bin/certbot /usr/bin/certbot
```

## Get Certificate
- Get chứng chỉ SSL cho web server 
```
sudo certbot --apache
```
- Thư mục lưu chứng chỉ thường là 
```
cd /etc/letsencrypt/live/<domain>
```
## Config SSL/TLS Mail Server
### Postfix
- File `main.cf`
    + Mở file 
    ```
    vim /etc/postfix/main.cf
    ```
    + Thêm những dòng sau: thay `<domain>` bằng domain mail server
    ```
    #Outbound
    smtp_tls_security_level=may
    smtp_tls_mandatory_protocols = !SSLv2, !SSLv3
    #Inbound 
    smtpd_tls_security_level = may
    smtpd_use_tls = yes
    smtpd_sasl_authenticated_header = yes
    smtpd_tls_mandatory_protocols = !SSLv2, !SSLv3
    smtpd_tls_cert_file = /etc/letsencrypt/live/<domain>/fullchain.pem
    smtpd_tls_key_file = /etc/letsencrypt/live/<domain>/privkey.pem
    smtpd_tls_session_cache_database = btree:${data_directory}/smtpd_scache
    smtpd_sasl_auth_enable = yes
    smtpd_tls_protocols = !SSLv2, !SSLv3
    smtpd_tls_received_header = yes
    broken_sasl_auth_clients = yes
    smtpd_tls_loglevel = 2
    tls_random_source = dev:/dev/urandom
    smtpd_sasl_authenticated_header = yes

    ```
- File `master.cf`
    + Mở file 
    ```
    vim /etc/postfix/master.cf
    ```
    + Trong phần `submission inet n       -       y       -       -       smtpd` enable các option sau 
    ```
      -o syslog_name=postfix/submission
      -o smtpd_sasl_auth_enable=yes
    ```
    + Trong phần `smtps     inet  n       -       y       -       -       smtpd` enable các option sau
    ```
      -o syslog_name=postfix/smtps
      -o smtpd_tls_wrappermode=yes
      -o smtpd_sasl_auth_enable=yes
    ```
### Dovecot 
- Sửa file 10-ssl.conf
    + Mở file 
    ```
    vim /etc/dovecot/conf.d/10-ssl.conf
    ```
    + Thiết lập giá trị `SSL = yes` 
    + Uncomment các dòng `ssl_key` `ssl_cert` và sửa đường dẫn về đúng thư mục lưu chứng chỉ 
    + File sẽ có dạng như sau 
    ```

    ssl = yes
    ssl_client_ca_dir = /etc/ssl/certs
    ssl_dh = </usr/share/dovecot/dh.pem
    ssl_cert = </etc/letsencrypt/live/<domain>/fullchain.pem
    ssl_key = </etc/letsencrypt/live/<domain>/privkey.pem

    ````
### Khởi động lại service để apply cấu hình 
```
systemctl restart postfix dovecot
```
## Test 
- Thêm mail mới vào Mail Client: ví dụ Thunderbird 
![](https://hackmd.io/_uploads/rJC0Nkva3.png)
- Gửi mail sang gmail có xác nhận TLS
![](https://hackmd.io/_uploads/r1NEByD6n.png)

## References

* [Enable TLS for Postfix on Ubuntu](https://blog.matrixpost.net/enable-tls-for-postfix-on-ubuntu/)
* [Mail Server : SSL/TLS Setting](https://www.server-world.info/en/note?os=Ubuntu_20.04&p=mail&f=5)