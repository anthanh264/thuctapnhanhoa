# Zimbra 8.8.15 - Ubuntu 20.04 
- Cài đặt Zimbra Collaboration Suite 8.8.15 trên Ubuntu 20.04 LTS
-----

## Hướng dẫn cài đặt Zimbra Collaboration Suite 8.8.15 trên Ubuntu 20.04 LTS
- Hướng dẫn về cách triển khai Zimbra Collaboration Suite (ZCS) phiên bản 8.8.15 trên một máy ảo VMware cục bộ chạy Ubuntu 20.04 LTS. 
- Địa chỉ IP cục bộ được sử dụng trong hướng dẫn này là `192.168.50.120`.

### Yêu cầu hệ thống

  * **Hệ điều hành:** Ubuntu 20.04 LTS (64-bit)
  * **RAM tối thiểu:** 8GB (khuyến nghị 16GB cho môi trường sản xuất)
  * **CPU:** 2 lõi (khuyến nghị 4 lõi trở lên)
  * **Dung lượng đĩa trống:** Tối thiểu 50GB (khuyến nghị 100GB trở lên)

-----

### Bước 1: Cấu hình Hostname và Hosts File

Trước khi cài đặt bất kỳ phần mềm nào, điều quan trọng là phải cấu hình chính xác hostname và file `/etc/hosts` để đảm bảo hệ thống nhận diện đúng tên miền và địa chỉ IP.

1.  **Đặt Hostname:**
    Sử dụng lệnh `hostnamectl` để đặt hostname cho hệ thống. Hãy thay thế `mail.your-domain.com` bằng **hostname đầy đủ của máy chủ Zimbra của bạn** (ví dụ: `mail.example.com`).

    ```bash
    hostnamectl set-hostname mail.your-domain.com
    ```

    Để xác minh hostname đã được đặt chính xác, bạn có thể kiểm tra nội dung của file `/etc/hostname`:

    ```bash
    cat /etc/hostname
    ```

    Kết quả mong đợi sẽ là `mail.your-domain.com`.
- ![images](./images/a-1.png)
2.  **Chỉnh sửa Hosts File:**
    Mở file `/etc/hosts` bằng trình soạn thảo `nano`:

    ```bash
    sudo nano /etc/hosts
    ```

    Thêm dòng sau vào cuối file, thay thế `192.168.50.120` bằng **địa chỉ IP cục bộ của máy ảo của bạn**, và `mail.your-domain.com`, `mail` bằng **hostname đầy đủ và shortname của bạn**.

    ```
    192.168.50.120    mail.your-domain.com     mail
    ```

    Lưu file bằng cách nhấn `Ctrl+O`, sau đó nhấn `Enter`, và thoát `nano` bằng cách nhấn `Ctrl+X`.
- ![images](./images/a-2.png)

-----

### Bước 2: Cập nhật hệ thống và gỡ bỏ phần mềm xung đột

Đảm bảo hệ thống của bạn được cập nhật và không có các phần mềm có thể xung đột với Zimbra.

1.  **Cập nhật gói hệ thống:**
    Cập nhật danh sách gói và nâng cấp tất cả các gói đã cài đặt lên phiên bản mới nhất:

    ```bash
    sudo apt update && sudo apt upgrade -y
    ```

2.  **Kiểm tra và gỡ bỏ Postfix, Apache2 (nếu có):**
    Zimbra bao gồm máy chủ mail và web server riêng. Do đó, bạn cần đảm bảo không có Postfix hoặc Apache2 đang chạy trên hệ thống để tránh xung đột cổng.

    Kiểm tra sự tồn tại của Postfix:

    ```bash
    dpkg -s postfix
    ```

    Kiểm tra sự tồn tại của Apache2:

    ```bash
    dpkg -s apache2
    ```

    Nếu bất kỳ gói nào trong số này được báo cáo là đã cài đặt, bạn nên gỡ bỏ chúng:

    ```bash
    sudo apt remove --purge postfix -y
    sudo apt remove --purge apache2 -y
    ```

3.  **Gỡ bỏ Snapd:**
    Trên Ubuntu 20.04 LTS, `snapd` thường được cài đặt mặc định và có thể tạo ra các thiết bị loop, dẫn đến các thông báo không cần thiết về việc sử dụng không gian đĩa từ Zimbra. Bạn nên gỡ bỏ nó.

    ```bash
    sudo apt remove --purge snapd -y
    ```
- ![images](./images/a-3.png)

-----

### Bước 3: Cấu hình DNS Server (Dnsmasq)

Zimbra yêu cầu một DNS server hoạt động để phân giải tên miền. Trong môi trường máy ảo cục bộ, bạn có thể cài đặt và cấu hình `dnsmasq` làm DNS server cục bộ đơn giản.

1.  **Vô hiệu hóa và dừng `systemd-resolved`:**
    `systemd-resolved` sử dụng cổng 53, cổng mà `dnsmasq` sẽ cần. Vô hiệu hóa và dừng nó trước khi cài đặt `dnsmasq`.

    ```bash
    sudo systemctl disable systemd-resolved
    sudo systemctl stop systemd-resolved
    ```

2.  **Gỡ bỏ symlink `/etc/resolv.conf`:**
    `/etc/resolv.conf` thường là một symlink đến một file do `systemd-resolved` quản lý. Bạn cần xóa symlink này để tạo một file `resolv.conf` mới thủ công.

    ```bash
    sudo rm /etc/resolv.conf
    ```

3.  **Tạo file `resolv.conf` mới:**
    Tạo file `/etc/resolv.conf` và thêm các máy chủ DNS mong muốn. Địa chỉ `127.0.0.1` sẽ trỏ đến `dnsmasq` cục bộ của bạn, và `8.8.8.8` (Google Public DNS) sẽ được sử dụng làm máy chủ dự phòng.

    ```bash
    sudo sh -c 'echo nameserver 127.0.0.1 >> /etc/resolv.conf'
    sudo sh -c 'echo nameserver 8.8.8.8 >> /etc/resolv.conf'
    ```

4.  **Cài đặt `dnsmasq`:**

    ```bash
    sudo apt install dnsmasq -y
    ```

5.  **Cấu hình `dnsmasq`:**
    Mở file cấu hình `dnsmasq`:

    ```bash
    sudo vi /etc/dnsmasq.conf
    ```

    Thêm các dòng sau vào cuối file. Thay thế `192.168.50.120` bằng **địa chỉ IP của máy ảo của bạn** và `your-domain.com` bằng **tên miền bạn muốn sử dụng cho Zimbra** (ví dụ: `example.com`).

    ```
    server=192.168.50.120
    domain=your-domain.com
    mx-host=your-domain.com, mail.your-domain.com, 5
    mx-host=mail.your-domain.com, mail.your-domain.com, 5
    listen-address=127.0.0.1
    ```

      * `server=192.168.50.120`: Chỉ định máy chủ DNS ngược dòng cho `dnsmasq` là chính nó (để giải quyết các truy vấn cho tên miền cục bộ).
      * `domain=your-domain.com`: Đặt tên miền cục bộ mà `dnsmasq` sẽ phục vụ.
      * `mx-host=your-domain.com, mail.your-domain.com, 5`: Định cấu hình bản ghi MX (Mail Exchanger) cho tên miền của bạn, chỉ ra rằng `mail.your-domain.com` là máy chủ mail với độ ưu tiên 5.
      * `listen-address=127.0.0.1`: Đảm bảo `dnsmasq` chỉ lắng nghe trên giao diện loopback.

    Lưu và thoát file.

6.  **Khởi động lại `dnsmasq`:**

    ```bash
    sudo systemctl restart dnsmasq
    ```

    Kiểm tra trạng thái của `dnsmasq` để đảm bảo nó đang chạy:

    ```bash
    sudo systemctl status dnsmasq
    ```

    Đảm bảo output hiển thị `active (running)`.

-----

### Bước 4: Cài đặt Zimbra 8.8.15

Bây giờ bạn đã sẵn sàng tải xuống và cài đặt Zimbra Collaboration Suite.

1.  **Chuyển đến thư mục `/tmp`:**
    Đây là một thư mục tốt để tải xuống các file tạm thời.

    ```bash
    cd /tmp
    ```

2.  **Tải xuống gói Zimbra 8.8.15:**
    Sử dụng lệnh `wget` để tải xuống gói Zimbra 8.8.15 cho Ubuntu 20.04.

    ```bash
    wget -c https://files.zimbra.com/downloads/8.8.15_GA/zcs-8.8.15_GA_4179.UBUNTU20_64.20211118033954.tgz
    ```

- ![images](./images/a-4.png)

3.  **Giải nén gói Zimbra:**
    Sau khi tải xuống, giải nén file `.tgz` đã tải xuống.

    ```bash
    tar -xzvf zcs-8.8.15_GA_4179.UBUNTU20_64.20211118033954.tgz
    ```

4.  **Chuyển vào thư mục cài đặt Zimbra:**

    ```bash
    cd zcs-8.8.15_GA_4179.UBUNTU20_64.20211118033954
    ```

5.  **Chạy script cài đặt:**
    Bắt đầu quá trình cài đặt Zimbra bằng cách chạy script `install.sh`.

    ```bash
    sudo ./install.sh
    ```

    Trình cài đặt sẽ dẫn bạn qua một loạt các lời nhắc. Dưới đây là các điểm chính cần lưu ý:

      * **Agreement:** Nhấn `Y` để chấp nhận Thỏa thuận Giấy phép.
      * **Packages to install:** Trình cài đặt sẽ hiển thị danh sách các gói Zimbra có sẵn.
          * Khi được hỏi **Install zimbra-dnscache? [Y]**, bạn **phải nhập `N` và nhấn Enter**.
          * Khi được hỏi **Install zimbra-imapd (BETA - for evaluation only)? [Y]**, bạn \*\*phải nhập `N` và nhấn Enter\`.
          * Đối với các gói khác, bạn có thể chấp nhận mặc định bằng cách nhấn `Enter`.
      * **System will be modified:** Nhấn `Y` để xác nhận việc cài đặt.
      * **Enter the domain name for this host:** Nhập **tên miền của bạn** (ví dụ: `your-domain.com`).
      * **Zimbra Admin Password:** Bạn sẽ được nhắc đặt mật khẩu cho tài khoản quản trị Zimbra. Hãy đặt một mật khẩu mạnh và ghi nhớ nó.
      * **Modify system? [Yes]**: Nhấn `Yes` để tiến hành cài đặt.

    Quá trình cài đặt sẽ mất một khoảng thời gian. Sau khi hoàn tất, bạn sẽ được hỏi liệu bạn có muốn thông báo cho Zimbra về việc cài đặt này hay không. Bạn có thể chọn `Yes` hoặc `No`.
```
Select the packages to install
Install zimbra-ldap [Y] y
Install zimbra-logger [Y] y
Install zimbra-mta [Y] y
Install zimbra-dnscache [Y] n
Install zimbra-snmp [Y] y
Install zimbra-store [Y] y
Install zimbra-apache [Y] y
Install zimbra-spell [Y] y
Install zimbra-memcached [Y] y
Install zimbra-proxy [Y] y
Install zimbra-drive [Y] y
Install zimbra-imapd (BETA - for evaluation only) [N] n
Install zimbra-chat [Y] y
Checking required space for zimbra-core
Checking space for zimbra-store
Checking required packages for zimbra-store
zimbra-store package check complete.


```
-----

### Bước 5: Kiểm tra trạng thái Zimbra

Sau khi cài đặt hoàn tất, bạn có thể kiểm tra trạng thái của các dịch vụ Zimbra để đảm bảo mọi thứ đang chạy bình thường.
```
Finished installing common zimlets.
Restarting mailboxd...done.
Creating galsync account for default domain...done.

You have the option of notifying Zimbra of your installation.
This helps us to track the uptake of the Zimbra Collaboration Server.
The only information that will be transmitted is:
        The VERSION of zcs installed (8.8.15_GA_4179_UBUNTU20_64)
        The ADMIN EMAIL ADDRESS created (admin@mail.annt.cloud)

Moving /tmp/zmsetup.20250721-030248.log to /opt/zimbra/log
Configuration complete - press return to exit
```
1.  **Chuyển sang người dùng `zimbra`:**
    Các lệnh quản lý Zimbra được thực thi dưới người dùng `zimbra`.

    ```bash
    su - zimbra
    ```

2.  **Kiểm tra trạng thái dịch vụ Zimbra:**

    ```bash
    zmcontrol status
    ```

    Output sẽ hiển thị trạng thái của tất cả các dịch vụ Zimbra. Đảm bảo rằng tất cả các dịch vụ được liệt kê là `Running`.

-----

### Bước 6: Truy cập giao diện quản trị Zimbra

Bây giờ Zimbra đã được cài đặt và chạy, bạn có thể truy cập giao diện quản trị web để quản lý máy chủ mail của mình.

Mở trình duyệt web và điều hướng đến địa chỉ sau:

  * **Giao diện quản trị Zimbra:** `https://mail.your-domain.com:7071`
  * **Webmail Zimbra (cho người dùng):** `https://mail.your-domain.com`

**Lưu ý:** Thay thế `your-domain.com` bằng **tên miền thực tế mà bạn đã cấu hình** trong các bước trước.

Sử dụng tên người dùng `admin` và mật khẩu bạn đã đặt trong quá trình cài đặt để đăng nhập vào giao diện quản trị.

-----

Chúc mừng\! Bạn đã cài đặt thành công Zimbra Collaboration Suite 8.8.15 trên Ubuntu 20.04 LTS. 

------------------
# Zimbra 8.8.15 - Ubuntu 20.04

-----

## Zimbra Collaboration Suite 8.8.15 Installation Guide on Ubuntu 20.04 LTS

This guide outlines how to deploy Zimbra Collaboration Suite (ZCS) version 8.8.15 on a local VMware virtual machine running Ubuntu 20.04 LTS.

The local IP address used in this guide is `192.168.50.120`.

### System Requirements

  * **Operating System:** Ubuntu 20.04 LTS (64-bit)
  * **Minimum RAM:** 8GB (16GB recommended for production environments)
  * **CPU:** 2 Cores (4+ cores recommended)
  * **Free Disk Space:** Minimum 50GB (100GB+ recommended)

-----

### Step 1: Configure Hostname and Hosts File

Before installing any software, it's crucial to properly configure the hostname and the `/etc/hosts` file to ensure the system correctly resolves the domain name and IP address.

1.  **Set Hostname:**
    Use the `hostnamectl` command to set the system's hostname. Replace `mail.your-domain.com` with **your Zimbra server's fully qualified hostname** (e.g., `mail.example.com`).

    ```bash
    hostnamectl set-hostname mail.your-domain.com
    ```

    To verify the hostname is set correctly, you can check the content of the `/etc/hostname` file:

    ```bash
    cat /etc/hostname
    ```

    The expected output should be `mail.your-domain.com`.

2.  **Edit Hosts File:**
    Open the `/etc/hosts` file using the `nano` editor:

    ```bash
    sudo nano /etc/hosts
    ```

    Add the following line to the end of the file, replacing `192.168.50.120` with **your virtual machine's local IP address**, and `mail.your-domain.com`, `mail` with **your fully qualified hostname and shortname**.

    ```
    192.168.50.120      mail.your-domain.com      mail
    ```

    Save the file by pressing `Ctrl+O`, then `Enter`, and exit `nano` by pressing `Ctrl+X`.

-----

### Step 2: Update System and Remove Conflicting Software

Ensure your system is up-to-date and free of any software that might conflict with Zimbra.

1.  **Update System Packages:**
    Update the package lists and upgrade all installed packages to their latest versions:

    ```bash
    sudo apt update && sudo apt upgrade -y
    ```

2.  **Check and Remove Postfix, Apache2 (if present):**
    Zimbra includes its own mail server and web server. Therefore, you need to ensure that Postfix or Apache2 are not running on the system to avoid port conflicts.

    Check for the presence of Postfix:

    ```bash
    dpkg -s postfix
    ```

    Check for the presence of Apache2:

    ```bash
    dpkg -s apache2
    ```

    If any of these packages are reported as installed, you should remove them:

    ```bash
    sudo apt remove --purge postfix -y
    sudo apt remove --purge apache2 -y
    ```

3.  **Remove Snapd:**
    On Ubuntu 20.04 LTS, `snapd` is often installed by default and can create loop devices, leading to unnecessary disk space usage messages from Zimbra. You should remove it.

    ```bash
    sudo apt remove --purge snapd -y
    ```

-----

### Step 3: Configure DNS Server (Dnsmasq)

Zimbra requires a working DNS server for domain name resolution. In a local virtual machine environment, you can install and configure `dnsmasq` as a simple local DNS server.

1.  **Disable and Stop `systemd-resolved`:**
    `systemd-resolved` uses port 53, which `dnsmasq` will need. Disable and stop it before installing `dnsmasq`.

    ```bash
    sudo systemctl disable systemd-resolved
    sudo systemctl stop systemd-resolved
    ```

2.  **Remove `/etc/resolv.conf` Symlink:**
    `/etc/resolv.conf` is typically a symlink to a file managed by `systemd-resolved`. You need to remove this symlink to manually create a new `resolv.conf` file.

    ```bash
    sudo rm /etc/resolv.conf
    ```

3.  **Create New `resolv.conf` File:**
    Create the `/etc/resolv.conf` file and add your desired DNS servers. `127.0.0.1` will point to your local `dnsmasq`, and `8.8.8.8` (Google Public DNS) will be used as a fallback.

    ```bash
    sudo sh -c 'echo nameserver 127.0.0.1 >> /etc/resolv.conf'
    sudo sh -c 'echo nameserver 8.8.8.8 >> /etc/resolv.conf'
    ```

4.  **Install `dnsmasq`:**

    ```bash
    sudo apt install dnsmasq -y
    ```

5.  **Configure `dnsmasq`:**
    Open the `dnsmasq` configuration file:

    ```bash
    sudo vi /etc/dnsmasq.conf
    ```

    Add the following lines to the end of the file. Replace `192.168.50.120` with **your VM's IP address** and `your-domain.com` with **the domain name you want to use for Zimbra** (e.g., `example.com`).

    ```
    server=192.168.50.120
    domain=your-domain.com
    mx-host=your-domain.com, mail.your-domain.com, 5
    mx-host=mail.your-domain.com, mail.your-domain.com, 5
    listen-address=127.0.0.1
    ```

      * `server=192.168.50.120`: Specifies the upstream DNS server for `dnsmasq` as itself (to resolve queries for the local domain).
      * `domain=your-domain.com`: Sets the local domain name that `dnsmasq` will serve.
      * `mx-host=your-domain.com, mail.your-domain.com, 5`: Configures the MX (Mail Exchanger) record for your domain, indicating that `mail.your-domain.com` is the mail server with priority 5.
      * `listen-address=127.0.0.1`: Ensures `dnsmasq` listens only on the loopback interface.

    Save and exit the file.

6.  **Restart `dnsmasq`:**

    ```bash
    sudo systemctl restart dnsmasq
    ```

    Check the status of `dnsmasq` to ensure it's running:

    ```bash
    sudo systemctl status dnsmasq
    ```

    Ensure the output shows `active (running)`.

-----

### Step 4: Install Zimbra 8.8.15

Now you are ready to download and install Zimbra Collaboration Suite.

1.  **Change to `/tmp` Directory:**
    This is a good directory for downloading temporary files.

    ```bash
    cd /tmp
    ```

2.  **Download Zimbra 8.8.15 Package:**
    Use the `wget` command to download the Zimbra 8.8.15 package for Ubuntu 20.04.

    ```bash
    wget -c https://files.zimbra.com/downloads/8.8.15_GA/zcs-8.8.15_GA_4179.UBUNTU20_64.20211118033954.tgz
    ```

3.  **Extract Zimbra Package:**
    After downloading, extract the downloaded `.tgz` file.

    ```bash
    tar -xzvf zcs-8.8.15_GA_4179.UBUNTU20_64.20211118033954.tgz
    ```

4.  **Change into Zimbra Installation Directory:**

    ```bash
    cd zcs-8.8.15_GA_4179.UBUNTU20_64.20211118033954
    ```

5.  **Run Installation Script:**
    Start the Zimbra installation process by running the `install.sh` script.

    ```bash
    sudo ./install.sh
    ```

    The installer will guide you through a series of prompts. Here are the key points to note:

      * **Agreement:** Press `Y` to accept the License Agreement.
      * **Packages to install:** The installer will display a list of available Zimbra packages.
          * When asked **Install zimbra-dnscache? [Y]**, you **must type `N` and press Enter**.
          * When asked **Install zimbra-imapd (BETA - for evaluation only)? [Y]**, you **must type `N` and press Enter**.
          * For other packages, you can accept the default by pressing `Enter`.
      * **System will be modified:** Press `Y` to confirm the installation.
      * **Enter the domain name for this host:** Enter **your domain name** (e.g., `your-domain.com`).
      * **Zimbra Admin Password:** You will be prompted to set a password for the Zimbra admin account. Set a strong password and remember it.
      * **Modify system? [Yes]**: Press `Yes` to proceed with the installation.

    The installation process will take some time. Once completed, you will be asked if you want to notify Zimbra about this installation. You can choose `Yes` or `No`.

    ```
    Select the packages to install
    Install zimbra-ldap [Y] y
    Install zimbra-logger [Y] y
    Install zimbra-mta [Y] y
    Install zimbra-dnscache [Y] n
    Install zimbra-snmp [Y] y
    Install zimbra-store [Y] y
    Install zimbra-apache [Y] y
    Install zimbra-spell [Y] y
    Install zimbra-memcached [Y] y
    Install zimbra-proxy [Y] y
    Install zimbra-drive [Y] y
    Install zimbra-imapd (BETA - for evaluation only) [N] n
    Install zimbra-chat [Y] y
    Checking required space for zimbra-core
    Checking space for zimbra-store
    Checking required packages for zimbra-store
    zimbra-store package check complete.
    ```

-----

### Step 5: Check Zimbra Status

After the installation is complete, you can check the status of the Zimbra services to ensure everything is running correctly.

```
Finished installing common zimlets.
Restarting mailboxd...done.
Creating galsync account for default domain...done.

You have the option of notifying Zimbra of your installation.
This helps us to track the uptake of the Zimbra Collaboration Server.
The only information that will be transmitted is:
        The VERSION of zcs installed (8.8.15_GA_4179_UBUNTU20_64)
        The ADMIN EMAIL ADDRESS created (admin@mail.annt.cloud)

Moving /tmp/zmsetup.20250721-030248.log to /opt/zimbra/log
Configuration complete - press return to exit
```

1.  **Switch to `zimbra` User:**
    Zimbra administration commands are executed under the `zimbra` user.

    ```bash
    su - zimbra
    ```

2.  **Check Zimbra Service Status:**

    ```bash
    zmcontrol status
    ```

    The output will show the status of all Zimbra services. Ensure that all services are listed as `Running`.

-----

### Step 6: Access Zimbra Admin Interface

Now that Zimbra is installed and running, you can access the web-based administration interface to manage your mail server.

Open a web browser and navigate to the following addresses:

  * **Zimbra Admin Interface:** `https://mail.your-domain.com:7071`
  * **Zimbra Webmail (for users):** `https://mail.your-domain.com`

**Note:** Replace `your-domain.com` with the **actual domain name you configured** in the previous steps.

Use the username `admin` and the password you set during the installation process to log in to the administration interface.

-----

Congratulations\! You have successfully installed Zimbra Collaboration Suite 8.8.15 on Ubuntu 20.04 LTS.