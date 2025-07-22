# Graylog Elasticsearch
- Tự động hóa việc thu thập, lưu trữ và phân tích dữ liệu log là một phần quan trọng trong việc quản lý hệ thống và khắc phục sự cố. **Graylog** kết hợp với **Elasticsearch** và **MongoDB** cung cấp một giải pháp mạnh mẽ để thực hiện điều này. 
- Hướng dẫn này trình bày cách cài đặt Graylog 5.0, Elasticsearch, và MongoDB trên Ubuntu 22.04

-----

## 1\. Chuẩn bị hệ thống

Đảm bảo hệ thống của bạn được cập nhật để tránh các vấn đề tương thích.

```bash
sudo apt update && sudo apt upgrade -y
```

-----

## 2\. Cài đặt Java

Graylog và Elasticsearch đều yêu cầu Java. Chúng ta sẽ cài đặt OpenJDK 11.

```bash
sudo apt install openjdk-11-jre-headless -y
```

Kiểm tra phiên bản Java đã cài đặt:

```bash
java -version
```

Bạn sẽ thấy thông tin về phiên bản Java 11.

-----

## 3\. Cài đặt MongoDB

MongoDB được sử dụng làm cơ sở dữ liệu để lưu trữ cấu hình và siêu dữ liệu của Graylog.

### 3.1. Tải và nhập khóa GPG của MongoDB

```bash
wget -qO - https://www.mongodb.org/static/pgp/server-6.0.asc | sudo apt-key add -
```

Thêm kho lưu trữ MongoDB vào danh sách nguồn của hệ thống:

```bash
echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu focal/mongodb-org/6.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-6.0.list
```

Cập nhật lại danh sách gói để hệ thống nhận diện kho lưu trữ mới:

```bash
sudo apt update
```

### 3.2. Tải và cài đặt thư viện hỗ trợ

Để MongoDB hoạt động chính xác trên Ubuntu 22.04, bạn cần cài đặt thủ công một phiên bản cũ hơn của thư viện `libssl`.

```bash
sudo wget http://archive.ubuntu.com/ubuntu/pool/main/o/openssl/libssl1.1_1.1.1f-1ubuntu2_amd64.deb
sudo dpkg -i libssl1.1_1.1.1f-1ubuntu2_amd64.deb
```

### 3.3. Cài đặt MongoDB

Bây giờ bạn có thể cài đặt MongoDB:

```bash
sudo apt install mongodb-org -y
```

### 3.4. Khởi động và bật MongoDB

Kích hoạt MongoDB để nó tự động khởi động cùng hệ thống và khởi động dịch vụ ngay lập tức:

```bash
sudo systemctl start mongod
sudo systemctl enable mongod
```

Để kiểm tra trạng thái của MongoDB:

```bash
sudo systemctl status mongod
```

-----

## 4\. Cài đặt Elasticsearch

Elasticsearch được Graylog sử dụng để lưu trữ và lập chỉ mục dữ liệu log.

### 4.1. Tải và nhập khóa GPG của Elasticsearch

```bash
wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
```

Thêm kho lưu trữ Elasticsearch 7.x vào danh sách nguồn của hệ thống:

```bash
echo "deb https://artifacts.elastic.co/packages/7.x/apt stable main" | sudo tee -a /etc/apt/sources.list.d/elastic-7.x.list
```

Cập nhật lại danh sách gói:

```bash
sudo apt update
```

### 4.2. Cài đặt Elasticsearch

```bash
sudo apt install elasticsearch -y
```

### 4.3. Cấu hình Elasticsearch

Mở tệp cấu hình Elasticsearch để điều chỉnh các tham số cần thiết cho Graylog.

```bash
sudo nano /etc/elasticsearch/elasticsearch.yml
```

Tìm và chỉnh sửa (hoặc thêm vào nếu không có) các dòng sau:

```yaml
cluster.name: graylog
network.host: 127.0.0.1
http.port: 9200
```

Lưu tệp bằng cách nhấn `Ctrl+X`, sau đó `Y`, và `Enter`.

### 4.4. Khởi động và bật Elasticsearch

Kích hoạt Elasticsearch để nó tự động khởi động cùng hệ thống và khởi động dịch vụ ngay lập tức:

```bash
sudo systemctl start elasticsearch
sudo systemctl enable elasticsearch
```

Để kiểm tra trạng thái của Elasticsearch:

```bash
sudo systemctl status elasticsearch
```

-----

## 5\. Cài đặt Graylog

Bây giờ chúng ta sẽ cài đặt Graylog server.

### 5.1. Tải và cài đặt kho lưu trữ Graylog

Tải gói kho lưu trữ Graylog:

```bash
wget https://packages.graylog2.org/repo/packages/graylog-5.0-repository_latest.deb
```

Cài đặt gói kho lưu trữ đã tải:

```bash
sudo dpkg -i graylog-5.0-repository_latest.deb
```

Cập nhật lại danh sách gói:

```bash
sudo apt update
```

### 5.2. Cài đặt Graylog Server

```bash
sudo apt install graylog-server -y
```

### 5.3. Cấu hình mật khẩu quản trị Graylog

Graylog yêu cầu một mật khẩu bí mật (`password_secret`) và một hash SHA256 của mật khẩu gốc (`root_password_sha2`) cho tài khoản quản trị.

**Bước 1: Tạo mật khẩu bí mật (YourGeneratedSecret)**

Sử dụng `pwgen` để tạo một chuỗi ngẫu nhiên dài 96 ký tự. Chuỗi này sẽ được sử dụng làm `password_secret`.

```bash
pwgen -N 1 -s 96
```

Lưu lại chuỗi này, ví dụ: `eC7rF9kJp0L2mN1bV3cZ4xS5dH6gA7fQ8wE9rT0yU1iO2pA3sD4fG5hJ6kL7zX8c9vB0nQ1wE2rT3yU4iO5pA6sD7fG8hJ9kL0`.

**Bước 2: Tạo hash SHA256 của mật khẩu gốc (YourSHA256Hash)**

Chọn một mật khẩu mạnh cho tài khoản quản trị Graylog (ví dụ: `Qwerty123@`). Sau đó, tạo hash SHA256 của mật khẩu này:

```bash
echo -n "YourStrongAdminPassword" | sha256sum
```

**Lưu ý:** Thay `YourStrongAdminPassword` bằng mật khẩu thực tế bạn muốn sử dụng.

Ví dụ, với mật khẩu `Qwerty123@`:

```bash
echo -n "Qwerty123@" | sha256sum
```

Kết quả sẽ là một chuỗi hash, ví dụ: `65e84be33532fb784c481296752719d4c01170bb80d85edb55f1de6e7dc10884`.

**Bước 3: Cấu hình Graylog Server**

Mở tệp cấu hình Graylog:

```bash
sudo nano /etc/graylog/server/server.conf
```

Tìm và chỉnh sửa (hoặc thêm vào nếu không có) các dòng sau với các giá trị bạn đã tạo:

```
password_secret = eC7rF9kJp0L2mN1bV3cZ4xS5dH6gA7fQ8wE9rT0yU1iO2pA3sD4fG5hJ6kL7zX8c9vB0nQ1wE2rT3yU4iO5pA6sD7fG8hJ9kL0
root_password_sha2 = 65e84be33532fb784c481296752719d4c01170bb80d85edb55f1de6e7dc10884
http_bind_address = 0.0.0.0:9000
```

**Lưu ý:** Thay thế các giá trị ví dụ bằng `YourGeneratedSecret` và `YourSHA256Hash` thực tế của bạn. `http_bind_address` là địa chỉ IP mà Graylog sẽ lắng nghe các kết nối web. `0.0.0.0:9000` cho phép truy cập từ mọi địa chỉ IP trên cổng 9000. Nếu bạn muốn giới hạn quyền truy cập, hãy thay `0.0.0.0` bằng địa chỉ IP của máy chủ.

Lưu tệp bằng cách nhấn `Ctrl+X`, sau đó `Y`, và `Enter`.

### 5.4. Khởi động và bật Graylog

Kích hoạt Graylog để nó tự động khởi động cùng hệ thống và khởi động dịch vụ ngay lập tức:

```bash
sudo systemctl start graylog-server
sudo systemctl enable graylog-server
```

-----

## 6\. Kiểm tra trạng thái dịch vụ

Sau khi cài đặt xong, bạn nên kiểm tra trạng thái của tất cả các dịch vụ để đảm bảo chúng đang chạy bình thường.

Kiểm tra log của Graylog để xem có lỗi nào không:

```bash
sudo tail -f /var/log/graylog-server/server.log
```

Kiểm tra trạng thái của Elasticsearch:

```bash
sudo systemctl status elasticsearch
```

Kiểm tra trạng thái của MongoDB:

```bash
sudo systemctl status mongod
```

Nếu tất cả các dịch vụ đều hiển thị trạng thái `active (running)`, thì quá trình cài đặt đã thành công.

-----

## 7\. Truy cập Graylog Web Interface

Bây giờ bạn có thể truy cập giao diện web của Graylog bằng cách mở trình duyệt và điều hướng đến địa chỉ IP của máy chủ Graylog trên cổng 9000.

Ví dụ: `http://your_server_ip:9000` (thay `your_server_ip` bằng địa chỉ IP thực tế của máy chủ Ubuntu của bạn).

Sử dụng thông tin đăng nhập sau:

  * **Username:** `admin`
  * **Password:** Mật khẩu mà bạn đã dùng để tạo `root_password_sha2` (ví dụ: `Qwerty123@`).

Chúc mừng\! Bạn đã cài đặt thành công Graylog, Elasticsearch và MongoDB trên Ubuntu 22.04. Bây giờ bạn có thể bắt đầu cấu hình các input để Graylog thu thập dữ liệu log của mình.