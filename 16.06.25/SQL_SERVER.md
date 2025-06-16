# SQL SERVER 
## 1. Tổng quan 
- Microsoft SQL Server là một hệ quản trị cơ sở dữ liệu quan hệ (RDBMS). Các ứng dụng và công cụ có thể kết nối với một phiên bản SQL Server hoặc một cơ sở dữ liệu, sử dụng Transact-SQL (T-SQL) để giao tiếp và thực hiện truy vấn dữ liệu.
- SQL Server được phát triển bởi Microsoft, hỗ trợ nhiều tính năng mạnh mẽ như quản lý giao dịch, xử lý dữ liệu lớn, bảo mật nâng cao, và khả năng tích hợp với các dịch vụ đám mây.
- SQL Server cung cấp nhiều công nghệ quan trọng giúp quản lý, phân tích và xử lý dữ liệu hiệu quả. Dưới đây là một số thành phần chính:
	- Database Engine: Là dịch vụ cốt lõi của SQL Server, chịu trách nhiệm lưu trữ, xử lý và bảo mật dữ liệu. Nó hỗ trợ truy cập có kiểm soát và xử lý giao dịch, đáp ứng nhu cầu của các ứng dụng yêu cầu dữ liệu lớn. Ngoài ra, nó còn hỗ trợ khôi phục cơ sở dữ liệu, giúp duy trì tính liên tục trong doanh nghiệp.
	- Machine Learning Services (MLS): Cho phép tích hợp học máy vào quy trình dữ liệu doanh nghiệp, sử dụng các ngôn ngữ R và Python. SQL Server hỗ trợ thực thi mô hình học máy ngay trong cơ sở dữ liệu, giúp đơn giản hóa quá trình xây dựng, huấn luyện và triển khai mô hình.
	- Integration Services (SSIS): Một nền tảng chuyên xử lý ETL (Extract, Transform, Load), hỗ trợ xây dựng quy trình tích hợp dữ liệu có hiệu suất cao. SSIS giúp xử lý kho dữ liệu, di chuyển dữ liệu giữa các hệ thống khác nhau, và tối ưu hóa quá trình chuyển đổi dữ liệu.
	- Analysis Services (SSAS): Công cụ phân tích dữ liệu mạnh mẽ, hỗ trợ mô hình OLAP, mô hình dữ liệu bảng và khai thác dữ liệu. SSAS có thể phân tích dữ liệu lớn để tìm ra các mẫu và mối quan hệ trong hệ thống.
	- Reporting Services (SSRS): Cung cấp khả năng báo cáo trên nền tảng web và doanh nghiệp. SSRS hỗ trợ tạo báo cáo từ nhiều nguồn dữ liệu, xuất ra nhiều định dạng khác nhau và quản lý quyền truy cập cùng đăng ký báo cáo.
	- Replication: Cho phép sao chép và phân phối dữ liệu giữa nhiều hệ thống, giúp đảm bảo tính nhất quán của dữ liệu. Hệ thống này hỗ trợ phân phối dữ liệu giữa nhiều vị trí khác nhau, kể cả qua mạng Internet và các kết nối không dây.
	- Data Quality Services (DQS): Giải pháp giúp làm sạch dữ liệu, loại bỏ dữ liệu sai sót hoặc trùng lặp bằng cách sử dụng cơ sở tri thức. DQS hỗ trợ tích hợp với SQL Server Integration Services để tạo quy trình quản lý dữ liệu hiệu quả.
	- Master Data Services (MDS): Hệ thống quản lý dữ liệu chính, giúp duy trì một kho lưu trữ trung tâm chứa dữ liệu quan trọng của tổ chức. MDS đảm bảo tính bảo mật, kiểm soát, và theo dõi lịch sử thay đổi dữ liệu theo thời gian.
- SQL Server hỗ trợ nhiều ngôn ngữ lập trình như C#, Java, Python và R. Nó có thể chạy trên cả Windows và Linux, đồng thời triển khai linh hoạt tại chỗ hoặc trên nền tảng đám mây.
- Các phiên bản SQL Server phổ biến:
	- Enterprise – Dành cho doanh nghiệp lớn, cung cấp bảo mật cao, phân tích nâng cao và hỗ trợ machine learning.
	- Standard – Phù hợp với ứng dụng tầm trung và hệ thống dữ liệu nhỏ.
	- WEB – Được thiết kế dành cho máy chủ web.
	- Developer – Chủ yếu sử dụng trong xây dựng, thử nghiệm và trình diễn ứng dụng.
	- Express – Phiên bản miễn phí, thích hợp cho các ứng dụng nhỏ.
- SQL Server cung cấp nhiều công cụ hỗ trợ quản lý, phân tích và báo cáo dữ liệu.
	- SQL Server Management Studio (SSMS) giúp quản lý và cấu hình SQL Server, hỗ trợ tạo và chỉnh sửa cơ sở dữ liệu, viết và chạy truy vấn SQL, cùng nhiều chức năng khác.
	- SQL Server Data Tools (SSDT) là môi trường phát triển tích hợp giúp thiết kế, triển khai và quản lý dự án SQL Server, hỗ trợ tạo thủ tục lưu trữ, chế độ xem, trigger.
	- SQL Server Configuration Manager cho phép quản lý cấu hình SQL Server, điều chỉnh cài đặt mạng, dịch vụ và phiên bản SQL Server.
	- SQL Server Profiler là công cụ theo dõi và gỡ lỗi, giúp giám sát hiệu suất máy chủ, lỗi truy vấn, trigger và các sự kiện khác.
	- SQL Server Integration Services (SSIS) hỗ trợ xử lý dữ liệu ETL (trích xuất, biến đổi, tải), giúp nhập, xuất và chuyển đổi dữ liệu giữa nhiều hệ thống.
	- SQL Server Analysis Services (SSAS) cung cấp các giải pháp phân tích dữ liệu, hỗ trợ OLAP, khai thác dữ liệu và machine learning.
	- SQL Server Reporting Services (SSRS) cho phép tạo và quản lý báo cáo dựa trên nhiều nguồn dữ liệu khác nhau.
	- SQL Server Command Line Utilities như SQLC® và BCP giúp thực thi tập lệnh SQL, nhập/xuất dữ liệu và quản lý cơ sở dữ liệu qua dòng lệnh.
- Ngôn ngữ truy vấn: Khác với SQL (Structured Query Language) là ngôn ngữ chuyên biệt dùng để quản lý dữ liệu trong hệ quản trị cơ sở dữ liệu quan hệ (RDBMS). SQL hỗ trợ truy vấn dữ liệu, thao tác dữ liệu, định nghĩa dữ liệu và kiểm soát truy cập dữ liệu thì Microsoft SQL Server sử dụng Transact-SQL (T-SQL), một ngôn ngữ truy vấn độc quyền để tương tác với hệ thống. Các truy vấn T-SQL có thể chạy thông qua SQL Server Utility trong SQL Server Management Studio (SSMS) hoặc qua công cụ sqlcmd. Ngoài ra, Azure Portal cung cấp Query Editor (preview) để thực thi câu lệnh SQL trực tiếp trên cơ sở dữ liệu Azure SQL.  
- Cấu trúc 
	- SQL Server hoạt động theo mô hình client-server, trong đó server chịu trách nhiệm lưu trữ và quản lý dữ liệu, còn client cho phép ứng dụng tương tác với server để thực hiện các thao tác trên dữ liệu.  
		- Workstation Components: Được cài đặt trên mỗi thiết bị của người dùng hoặc máy quản trị SQL Server. Đây là giao diện giúp tương tác với Server Components. Ví dụ: SSMS (SQL Server Management Studio), SSCM (SQL Server Configuration Manager), Profiler, BIDS (Business Intelligence Development Studio), SQLEM.
		- Server Components: Được cài đặt trên máy chủ trung tâm, bao gồm các dịch vụ giúp SQL Server hoạt động. Ví dụ: SQL Server, SQL Server Agent, SSIS (SQL Server Integration Services), SSAS (SQL Server Analysis Services), SSRS (SQL Server Reporting Services), SQL Browser, SQL Server Full-Text Search.
	- Hệ thống này hỗ trợ SQL (Structured Query Language) để quản lý dữ liệu, đồng thời cung cấp nhiều công cụ để tạo, giám sát, tối ưu hóa cơ sở dữ liệu và quản lý hiệu suất máy chủ. SQL Server còn tích hợp các tính năng quản lý giao dịch, sao lưu và phục hồi dữ liệu, bảo mật, và business intelligence, giúp doanh nghiệp phân tích dữ liệu hiệu quả.  
	- SQL Server được sử dụng rộng rãi trong các hệ thống quản lý dữ liệu doanh nghiệp, chẳng hạn như tài chính, thương mại điện tử, CRM, nhờ vào khả năng xử lý dữ liệu lớn. Hệ thống này có nhiều phiên bản khác nhau như Express, Standard, Enterprise, Developer, mỗi phiên bản cung cấp các tính năng và tùy chọn giấy phép phù hợp với từng nhu cầu kinh doanh.  
![images](./images/dtb-2.webp)
- Ưu điểm:
	- Khả năng mở rộng linh hoạt, phù hợp với mọi quy mô tổ chức.
	- Bảo mật cao, với các tính năng mã hóa và kiểm toán giúp bảo vệ dữ liệu khỏi truy cập trái phép.
	- Tích hợp tốt với các sản phẩm của Microsoft như SharePoint và PowerBI, giúp làm việc với dữ liệu dễ dàng hơn.
	- Hỗ trợ phân tích kinh doanh, bao gồm công cụ SQL Server Reporting Services và SQL Server Analysis Services.
	- Đảm bảo tính sẵn sàng cao với Always On Availability Groups, giúp duy trì hoạt động ngay cả khi có sự cố.
	- Hỗ trợ nhiều ngôn ngữ lập trình như T-SQL, Python, R và JSON.
	- Xử lý dữ liệu lớn hiệu quả, phù hợp với các ứng dụng yêu cầu khối lượng dữ liệu cao.
	- Cộng đồng hỗ trợ mạnh mẽ, với nhiều nhà phát triển và người dùng chia sẻ kinh nghiệm.
	- Tùy chọn cấp phép linh hoạt, cho phép doanh nghiệp lựa chọn mô hình phù hợp.
	- Tích hợp tốt với nền tảng đám mây như Microsoft Azure, cung cấp sự linh hoạt và khả năng mở rộng cao.
- Nhược điểm:
	- Chi phí cao, đặc biệt đối với các tổ chức lớn hoặc yêu cầu xử lý dữ liệu lớn.
	- Cấu hình phức tạp, cần kỹ năng chuyên sâu để quản lý hiệu quả.
	- Tiêu tốn tài nguyên, đòi hỏi phần cứng và phần mềm mạnh để vận hành tốt.
	- Khả năng di động hạn chế, chủ yếu hoạt động trên nền tảng Windows.
	- Mô hình cấp phép phức tạp, yêu cầu quản lý chặt chẽ để tuân thủ quy định.
	- Giới hạn hiệu suất trong một số trường hợp, có thể không tối ưu bằng các hệ thống quản lý dữ liệu khác.
	- Dữ liệu có thể bị phân mảnh, nếu không được bảo trì đúng cách, gây ảnh hưởng đến hiệu suất.
	- Tùy chỉnh phức tạp, có thể cần nhiều tài nguyên phát triển bổ sung.
	- Hỗ trợ hạn chế đối với công nghệ mã nguồn mở, so với một số hệ thống khác.
	- Ràng buộc với nhà cung cấp, có thể gây khó khăn trong việc chuyển đổi sang hệ thống khác trong tương lai.
## 2. Cài đặt và cấu hình tối ưu 
### 2.1 Yêu cầu hệ thống   
- Trên Windows 
	- Phần cứng:  
		- Bộ xử lý: X64, tối thiểu 1.4 GHz (khuyến nghị 2.0 GHz+).  
		- Bộ nhớ:  
		  - Express: Tối thiểu 512 MB (khuyến nghị 1 GB).  
		  - Các phiên bản khác: Tối thiểu 1 GB (khuyến nghị 4 GB+).  
		- Lưu trữ: Tối thiểu 6 GB dung lượng ổ cứng.  
		- Loại CPU: Intel hoặc AMD x86-64, tối đa 64 lõi mỗi NUMA node.  
	- Phần mềm:  
		- Hệ điều hành: Windows Server hoặc Windows 10/11.  
		- Kết nối Internet: Cần thiết cho một số tính năng (có thể phát sinh phí).  
		- Hệ thống tập tin: Hỗ trợ NTFS hoặc ReFS.  

- Trên Linux
	- Phần cứng:  
		- Bộ xử lý: X64 tương thích.  
		- Số lõi: Tối thiểu 2 lõi.  
		- Bộ nhớ: Tối thiểu 2 GB RAM.  
		- Tốc độ xử lý: Tối thiểu 2 GHz.  
		- Lưu trữ: Tối thiểu 6 GB dung lượng ổ cứng.  
	- Phần mềm:  
		- Hệ thống tập tin: Hỗ trợ XFS hoặc EXT4.  
		- Hệ thống tập tin mạng (NFS): Phiên bản 4.2 trở lên.  
		- Lưu ý: Thư mục `/var/opt/mssql` chỉ có thể được gắn kết trên NFS.  

<!-- TOC --><a name="322-quy-trình-cài-t-c-bn"></a>
### 2.2 Quy trình cài đặt cơ bản
<!-- TOC --><a name="windows"></a>
#### Windows   
- Truy cập trang chủ để tải file cài 
- ![images](./images/d-37.png)
- Chạy file launcher để tải file cài đặt: Chọn express advanced 
- ![images](./images/d-38.png)
- Tải xuống file cài đặt 
- ![images](./images/d-39.png)
- Click open để mở thư mục chứa file mới tải và chạy file 
- ![images](./images/d-40.png)
- ![images](./images/d-41.png)
- Extract 
- ![images](./images/d-42.png)
- Chọn Install 
- ![images](./images/d-43.png)
- Next
- ![images](./images/d-44.png)
- Preinstall check 
- ![images](./images/d-45.png)
- Cấu hình dịch vụ sẽ cài 
- ![images](./images/d-46.png)
- Cấu hình tên 
- ![images](./images/d-47.png)
- Cấu hình service accounts 
- ![images](./images/d-48.png)
- Chọn Mixed Mode và cấu hình password accounts `sa` 
- ![images](./images/d-49.png)
- Qúa trình cài đặt diễn ra 
- ![images](./images/d-50.png)
- Hoàn tất cài đặt 
- ![images](./images/d-54.png)
- Cài SSMS để truy cập quản lý 
- ![images](./images/d-55.png)
- Tải file và khởi chạy 
- ![images](./images/d-56.png)
- ![images](./images/d-57.png)
- Cấu hình các tính năng đi kèm 
- ![images](./images/d-60.png)
- ![images](./images/d-61.png)
- Cấu hình gói ngôn ngữ 
- ![images](./images/d-62.png)
- Cấu hình nơi lưu
- ![images](./images/d-63.png)
- Chọn Install - Quá trình cài đặt diễn ra 
- ![images](./images/d-64.png)
- Cài dat xong 
- ![images](./images/d-71.png)
- Launch 
- ![images](./images/d-72.png)
- Kết nối từ client 
- ![images](./images/d-73.png)
- Kết nối thành công 
- ![images](./images/d-74.png)
- Kết nối thử bằng user sa 
- ![images](./images/d-75.png)
- Kết nối thành công 
- ![images](./images/d-74.png)
<!-- TOC --><a name="linux-ubuntu"></a>
#### Linux (Ubuntu)
- Thêm SQL Server 2022 Repository và cài đặt 
```
wget https://packages.microsoft.com/keys/microsoft.asc -O /etc/apt/keyrings/mssql2022.key
wget https://packages.microsoft.com/config/ubuntu/22.04/mssql-server-2022.list -O /etc/apt/sources.list.d/mssql-server-2022.list
wget https://packages.microsoft.com/config/ubuntu/22.04/prod.list -O /etc/apt/sources.list.d/msprod.list
```
- ![images](./images/d-51.png)
- Thêm source List
```
nano /etc/apt/sources.list.d/mssql-server-2022.list
```
```
deb [signed-by=/etc/apt/keyrings/mssql2022.key arch=amd64,armhf,arm64] https://packages.microsoft.com/ubuntu/22.04/prod jammy main
```
- ![images](./images/d-52.png)
- Cập nhập Repo Database 
```
apt udpate 
```
- ![images](./images/d-53.png)
- Note: 
	- Sửa lỗi 
	```
	W: GPG error: https://packages.microsoft.com/ubuntu/22.04/mssql-server-2022 jammy InRelease: The following signatures couldn't be verified because the public key is not available: NO_PUBKEY EB3E94ADBE1229CF
	E: The repository 'https://packages.microsoft.com/ubuntu/22.04/mssql-server-2022 jammy InRelease' is not signed.
	```
	- Chạy lệnh 
	```
	wget https://packages.microsoft.com/config/ubuntu/22.04/packages-microsoft-prod.deb -O packages-microsoft-prod.deb
	sudo dpkg -i packages-microsoft-prod.deb
	rm packages-microsoft-prod.deb
	```
	- ![images](./images/d-58.png)
	
- Cài đặt SQL-Server 
``` 
apt -y install mssql-server mssql-tools unixodbc-dev
```
- ![images](./images/d-58.png)
- Accept term:
- ![images](./images/d-65.png)
- ![images](./images/d-66.png)
- Thiết lập ban đầu
```
/opt/mssql/bin/mssql-conf setup
```
- Chọn bản miễn phí (3), Accept terms, Cấu hình password admin 
- ![images](./images/d-67.png)
- Hoàn tất cài đặt kiểm tra hoạt động 
```
 systemctl status mssql-server
```
- ![images](./images/d-68.png)
- Thiết lập đường dẫn PATH cho các công cụ của Microsoft SQL Server (MSSQL) trên hệ thống Linux, đảm bảo rằng các lệnh sqlcmd và bcp có thể được sử dụng từ bất kỳ đâu trong terminal.
```
echo 'export PATH=$PATH:/opt/mssql-tools/bin' > /etc/	profile.d/mssql.sh
source /etc/profile.d/mssql.sh
```
- ![images](./images/d-69.png)
- Đăng nhập qua dòng lệnh 
```
sqlcmd -S localhost -U SA
select name,database_id from sys.databases;
go
select name from sysusers;
go
select current_user;
go
exit
```
- ![images](./images/d-70.png)
-Kết nối từ ssms trên client windows 
- ![images](./images/d-76.png)
- ![images](./images/d-78.png)

<!-- TOC --><a name="323-cu-hình-ti-u-hiu-nng"></a>
### 2.3 Cấu hình tối ưu hiệu năng
- Cấu hình dung lượng RAM tối đa: Tại server SQL chọn Properties 
- ![images](./images/d-82.png)
- ![images](./images/d-81.png)
- Mức độ song song tối đa mặc định (MAXDOP)
	- MAXDOP là cấu hình cho phép SQLServer sử dụng bao nhiêu Processor của CPU để thực hiện các query (plan execution)
	- Mặc định SQLServer để MAXDOP = 0 là cho phép dùng tất cả các processor có thể của máy chủ và max = 64.
	- Có thể cấu hình giá trị này thông qua query 
	```
	-- Kiểm tra giá trị hiện tại
	EXEC sp_configure 'max degree of parallelism';

	-- Thay đổi nếu cần
	EXEC sp_configure 'max degree of parallelism', 4;  
	RECONFIGURE;
	```
	- Hoặc sử dụng giao diện : Tại server SQL chọn Properties 
	- ![images](./images/d-81.png)
	- Tại mục Advanced -> Max degree of parallelism
	- ![images](./images/d-83.png)
- Cost threshold for parallelism:
	- Đây là giá trị cấu hình ngưỡng chi phí của 1 query mà ở đó SQLServer bắt đầu xem xét thực thi query đó bằng multiple thread.
	- Thông thường các query đơn giản có cost < 50
	- Trong khi đó default của SQLServer là 5, quá bé, ta set ngưỡng này là 50 (tức là dưới 50 thì không cần chạy song song nhiều thread)
	- Có thể cấu hình giá trị này thông qua query 
	```
	-- Kiểm tra
	EXEC sp_configure 'cost threshold for parallelism';

	-- Thay đổi nếu cần
	EXEC sp_configure 'cost threshold for parallelism', 25;
	RECONFIGURE;
	```
	- Hoặc sử dụng giao diện : Tại server SQL chọn Properties 
	- ![images](./images/d-81.png)	
	- Tại mục Advanced -> Cost threshold for parallelism
	- ![images](./images/d-84.png)
- Cấu hình FileGrowth cho Data và Log
	- Là khả năng tăng trưởng mỗi lần của file Data và Log. Khuyến nghị ở đây là:
		- 256MB dành cho Data
		- 128MB dành cho Log
	- Có thể cấu hình giá trị này thông qua query 		
	```
	-- Kiểm tra filegrowth hiện tại
	SELECT name, physical_name, growth, is_percent_growth
	FROM sys.master_files
	WHERE database_id = DB_ID('YourDB');
	```
	- ![images](./images/d-85.png)
	```
	-- Chỉnh lại: không dùng % mà dùng MB cụ thể
	ALTER DATABASE YourDB
	MODIFY FILE (NAME = 'YourDB_Data', FILEGROWTH = 256MB);
	```
	- ![images](./images/d-86.png)
	- ![images](./images/d-87.png)
	- Hoặc sử dụng giao diện : Tại Database chọn Properties 
	- ![images](./images/d-88.png)
	- ![images](./images/d-89.png)
- Auto tuning (available only in the Enterprise and Developer editions of SQL Server.)
	- Tự động điều chỉnh là một tính năng của cơ sở dữ liệu giúp nhận biết các vấn đề tiềm ẩn về hiệu suất truy vấn, đề xuất giải pháp và tự động khắc phục các sự cố đã xác định.
	- Tính năng tự động điều chỉnh, được giới thiệu trong SQL Server 2017 (14.x), sẽ thông báo khi phát hiện vấn đề hiệu suất và cho phép bạn thực hiện các hành động khắc phục hoặc để Database Engine tự động sửa lỗi. SQL Server với tự động điều chỉnh có thể xác định và khắc phục các vấn đề hiệu suất do hồi quy lựa chọn kế hoạch thực thi truy vấn. Trong Azure SQL Database và SQL database trong Microsoft Fabric, tự động điều chỉnh cũng tạo chỉ mục cần thiết và loại bỏ các chỉ mục không sử dụng. 
	- Tự động điều chỉnh là một quá trình giám sát và phân tích liên tục nhằm tìm hiểu đặc điểm của khối lượng công việc, xác định các vấn đề tiềm ẩn và đề xuất các cải thiện.
	- Lợi ích của tự động điều chỉnh SQL Server. Tự động điều chỉnh hiệu suất cơ sở dữ liệu mang lại các lợi ích sau:  
		- Tự động xác minh cải thiện hiệu suất – Đảm bảo mọi thay đổi đều mang lại lợi ích thực sự.  
		- Tự động hoàn tác và tự sửa lỗi – Nếu một thay đổi không cải thiện hiệu suất, hệ thống sẽ tự động hoàn tác.  
		- Lịch sử điều chỉnh – Lưu lại các hành động tối ưu hóa để người dùng có thể tham khảo và phân tích.  
		- Tùy chỉnh bằng T-SQL – Cung cấp các tập lệnh Transact-SQL (T-SQL) để triển khai thủ công.  
		- Khả năng mở rộng – Có thể áp dụng tự động điều chỉnh trên hàng trăm nghìn cơ sở dữ liệu.  
		- Ảnh hưởng tích cực đến DevOps – Giúp tối ưu tài nguyên DevOps và giảm tổng chi phí sở hữu (TCO).  
	- Quy trình tự động điều chỉnh
		- ![images](./images/tuning-process.png)
		- Quá trình này giúp cơ sở dữ liệu thích ứng động với khối lượng công việc bằng cách xác định các chỉ mục và kế hoạch truy vấn có thể cải thiện hiệu suất. Dựa trên những phát hiện này, hệ thống sẽ thực hiện các hành động điều chỉnh để tối ưu hóa hiệu suất.  
		- Sau khi áp dụng các thay đổi, SQL Server tiếp tục giám sát hiệu suất để đảm bảo sự cải thiện. Nếu bất kỳ thay đổi nào không mang lại lợi ích, hệ thống sẽ tự động hoàn tác. Đây là một tính năng quan trọng giúp đảm bảo rằng mọi điều chỉnh không làm giảm hiệu suất tổng thể của khối lượng công việc.
		- Bật tính năng tự động điều chỉnh lựa chọn kế hoạch
		- Có thể bật tự động điều chỉnh cho từng cơ sở dữ liệu và chỉ định rằng kế hoạch tốt nhất trước đó sẽ được áp dụng khi phát hiện hồi quy lựa chọn kế hoạch.
	- Tính năng này được bật bằng lệnh sau trong SQL Server:
	```
	ALTER DATABASE <yourDatabase>
	SET AUTOMATIC_TUNING ( FORCE_LAST_GOOD_PLAN = ON );
	```
	- Sau khi kích hoạt tùy chọn này, Database Engine sẽ tự động ép buộc kế hoạch được đề xuất nếu:
		- Lợi ích CPU ước tính lớn hơn 10 giây.
		- Số lỗi trong kế hoạch mới nhiều hơn số lỗi trong kế hoạch được đề xuất.
		- Ngoài ra, hệ thống sẽ kiểm tra lại để đảm bảo kế hoạch ép buộc tốt hơn kế hoạch hiện tại.

<!-- TOC --><a name="324-cu-hình-bo-mt-c-bn"></a>
### 2.4 Cấu hình bảo mật cơ bản
- Disable xp_cmdshell: Tắt để tránh chạy lệnh hệ thống từ SQL
	- Có thể cấu hình giá trị này thông qua query 	 
	```
	-- Tắt xp_cmdshell
	EXEC sp_configure 'show advanced options', 1; RECONFIGURE;
	EXEC sp_configure 'xp_cmdshell', 0; RECONFIGURE;
	```
	- ![images](./images/d-90.png)
	- Hoặc sử dụng giao diện: Tại Server -> Faucets -> Security -> xp_cmdshell
	- ![images](./images/d-91.png)
	- ![images](./images/d-92.png)
	- ![images](./images/d-93.png)
- Kiểm soát quyền truy cập
	- Bật audit: Tại server SQL chọn Properties -> Security -> Login Auditing 
	- ![images](./images/d-94.png)
	- ![images](./images/d-95.png)
	- Không sử dụng `sa`, nếu dùng thì cần cấu hình mật khẩu mạnh 
	```
	ALTER LOGIN sa DISABLE;
	-- Hoặc dùng thì cần set pass mạnh
	ALTER LOGIN sa WITH PASSWORD = 'M@xS3cur323!@$#@P@ss!';
	```
- Bảo mật dữ liệu với TDE (Enterprise Feature)
- Transparent Data Encryption (TDE) là một cơ chế mã hóa cấp cơ sở dữ liệu, đảm bảo dữ liệu được lưu trữ trong SQL Server được bảo vệ khỏi các truy cập trái phép bằng cách mã hóa toàn bộ nội dung của cơ sở dữ liệu trên ổ đĩa.
- TDE sử dụng hệ thống phân cấp mã hóa để đảm bảo tính bảo mật và toàn vẹn của dữ liệu. Quá trình này bao gồm các thành phần sau:
	- Windows Data Protection API (DPAPI) – Đây là lớp bảo mật cấp hệ điều hành, có nhiệm vụ giải mã Service Master Key (SMK).
	- Service Master Key (SMK) – Được tạo tự động khi cài đặt SQL Server lần đầu, SMK chịu trách nhiệm mã hóa Database Master Key (DMK).
	- Database Master Key (DMK) – Được tạo trong master database, có nhiệm vụ mã hóa Chứng chỉ bảo mật (Certificate).
	- Certificate – Chứng chỉ này được sử dụng để tạo Database Encryption Key (DEK). Quan trọng: Người quản trị phải sao lưu chứng chỉ này để đảm bảo có thể khôi phục dữ liệu trong trường hợp xảy ra lỗi hệ thống.
	- Database Encryption Key (DEK) – Khóa cuối cùng trong chuỗi mã hóa, dùng để kích hoạt TDE trên một cơ sở dữ liệu cụ thể.
- Để triển khai Transparent Data Encryption (TDE), bạn cần sử dụng phiên bản SQL Server phù hợp. Đây là một tính năng yêu cầu bản Enterprise, nhưng cũng có sẵn trong Developer Edition (chỉ dùng cho thử nghiệm và phát triển). Trong môi trường sản xuất, bạn bắt buộc phải có phiên bản SQL Server hỗ trợ TDE.
- ![images](./images/tde.webp)
- Cấu hình 
	- Tạo Master Key
	```
	USE Master;
	GO
	CREATE MASTER KEY ENCRYPTION
	BY PASSWORD='5R^0g6EW92g6C&/pz90yx%)';
	GO
	```
	- Create Certificate protected by master key
	```
	CREATE CERTIFICATE TDE_Cert
	WITH 
	SUBJECT='Database_Encryption';
	GO
	```
	- Create Database Encryption Key
	```
	USE DB_Test
	GO
	CREATE DATABASE ENCRYPTION KEY
	WITH ALGORITHM = AES_256
	ENCRYPTION BY SERVER CERTIFICATE TDE_Cert;
	GO
	```
	- Enable Encryption
	```
	ALTER DATABASE DB_Test
	SET ENCRYPTION ON;
	GO
	```
	- Backup Certificate
	```
	BACKUP CERTIFICATE TDE_Cert
	TO FILE = 'C:\temp\TDE_Cert'
	WITH PRIVATE KEY (file='C:\temp\TDE_CertKey.pvk',
	ENCRYPTION BY PASSWORD='5R^0g6EW92g6C&/pz90yx%)') 
	```
	- Restoring a Certificate
	```
	USE Master;
	GO
	CREATE MASTER KEY ENCRYPTION
	BY PASSWORD='5R^0g6EW92g6C&/pz90yx%)';
	GO
	```
	```
	USE MASTER
	GO
	CREATE CERTIFICATE TDECert
	FROM FILE = 'C:\Temp\TDE_Cert'
	WITH PRIVATE KEY (FILE = 'C:\TDECert_Key.pvk',
	DECRYPTION BY PASSWORD = '5R^0g6EW92g6C&/pz90yx%)' );
	```

### 2.5 Backup và Restore 
- Backup 
	- Sử dụng SSMS 
		- Khởi chạy SQL Server Management Studio (SSMS) và kết nối với phiên bản SQL Server.
		- Mở rộng nút Databases trong Object Explorer.
		- Nhấp chuột phải vào cơ sở dữ liệu, di chuột qua Tasks, rồi chọn Back up....
		- ![images](./images/d-245.png)  
		- Trong phần Destination, xác nhận rằng đường dẫn sao lưu là chính xác. Nếu cần thay đổi đường dẫn, chọn Remove để xóa đường dẫn hiện tại, rồi chọn Add để nhập đường dẫn mới. 
		- ![images](./images/d-246.png)  
		- Chọn OK để tiến hành sao lưu cơ sở dữ liệu.
		- ![images](./images/d-247.png)  

	- T-SQL
	```
	BACKUP DATABASE [database_name] 
	TO DISK = 'C:\Backup\backup_file.bak' 
	WITH INIT
	```
	- ![images](./images/d-255.png)  

- Restore 
	- Sử dụng SSMS 
		- Khởi chạy SQL Server Management Studio (SSMS) và kết nối với phiên bản SQL Server.
		- Nhấp chuột phải vào nút Databases trong Object Explorer và chọn Restore Database....
		- ![images](./images/d-248.png)  
		Chọn Device:, sau đó nhấp vào dấu ba chấm (...) để tìm tệp sao lưu.
		- ![images](./images/d-249.png)  
		Chọn Add và điều hướng đến vị trí chứa tệp .bak. Chọn tệp .bak, rồi nhấp OK.
		- ![images](./images/d-250.png)  
		- ![images](./images/d-251.png)  
		- ![images](./images/d-252.png)  
		- Nhấp OK để khôi phục cơ sở dữ liệu từ bản sao lưu.
		- ![images](./images/d-253.png)  
		- Restore thành công 
		- ![images](./images/d-254.png)  
	- T-SQL
		```
		RESTORE DATABASE [database_name] 
		FROM DISK = 'C:\Backup\backup_file.bak' 
		WITH RECOVERY
		```
		- ![images](./images/d-256.png)  

### 2.6 Giám sát cơ bản  
- Sử dụng T-SQL 
	- Theo dõi trạng thái hệ thống với `sys.dm_os_wait_stats`
	- Kiểm tra các loại độ trễ xảy ra trong SQL Server:
	```sql
	SELECT wait_type, waiting_tasks_count, wait_time_ms, signal_wait_time_ms
	FROM sys.dm_os_wait_stats
	ORDER BY wait_time_ms DESC;
	```
	- `wait_type` → Loại sự kiện chờ.
	- `waiting_tasks_count` → Số lần nhiệm vụ phải chờ.
	- `wait_time_ms` → Tổng thời gian chờ (ms).
	- `signal_wait_time_ms` → Thời gian chờ xử lý sau khi được lên lịch.
	- ![images](./images/d-276.png)
	- Kiểm tra hiệu quả sử dụng chỉ mục với `sys.dm_db_index_usage_stats`
	- Phát hiện chỉ mục không được sử dụng hoặc sử dụng quá mức:
	```sql
	SELECT object_name(i.object_id) AS table_name, i.name AS index_name, 
	user_seeks, user_scans, user_lookups, user_updates
	FROM sys.dm_db_index_usage_stats u
	JOIN sys.indexes i ON u.object_id = i.object_id AND u.index_id = i.index_id
	WHERE database_id = DB_ID('YourDatabaseName')
	ORDER BY user_scans DESC;
	```
	- ![images](./images/d-277.png)
	- Giám sát hiệu suất đĩa với `sys.dm_io_virtual_file_stats`
	- Kiểm tra hiệu suất I/O của SQL Server:
	```sql
	SELECT database_id, file_id, num_of_reads, num_of_writes, 
	io_stall_read_ms, io_stall_write_ms 
	FROM sys.dm_io_virtual_file_stats(NULL, NULL)
	ORDER BY io_stall_read_ms DESC;
	```
	- ![images](./images/d-278.png)
- Report của SSMS 
	- Click chuột phải vào instance -> Report ->Standard Report -> Performance Dashboard 
	- ![images](./images/d-274.png)
	- ![images](./images/d-275.png)
	- Bên cạnh đó SSMS còn nhiều report khác về hiệu năng 
	- ![images](./images/d-278.png)
	- ![images](./images/d-280.png)
	- ![images](./images/d-281.png)

### 2.7 Tối ưu truy vấn 
- Ngôn ngữ truy vấn có cấu trúc (SQL) là một ngôn ngữ lập trình tiêu chuẩn dùng để quản lý các cơ sở dữ liệu quan hệ. SQL Server là một hệ quản trị cơ sở dữ liệu quan hệ (RDBMS) do Microsoft phát triển.
- Khi làm việc với lượng dữ liệu lớn, việc tối ưu hóa truy vấn để đạt hiệu suất tốt hơn là rất quan trọng. Các kỹ thuật tối ưu hóa truy vấn được sử dụng để đạt được mục tiêu này. SQL Server, một trong những hệ quản trị cơ sở dữ liệu quan hệ phổ biến nhất, cung cấp nhiều phương pháp để tối ưu hóa truy vấn.
- Sử dụng Indexes
	- Chỉ mục (Index) là một cấu trúc dữ liệu giúp tổ chức dữ liệu để tăng tốc độ tìm kiếm thông tin cụ thể. Các chỉ mục cải thiện hiệu suất truy vấn SQL bằng cách cung cấp cách tìm dữ liệu nhanh hơn trong cơ sở dữ liệu. Khi tạo chỉ mục trên một cột, SQL Server có thể tìm dữ liệu nhanh hơn vì nó không cần quét toàn bộ bảng.
	- SQL Server cung cấp hai loại chỉ mục:
	- Clustered Index: Xác định thứ tự vật lý của dữ liệu trong bảng.
	- Non-clustered Index: Tạo một cấu trúc riêng để lưu trữ giá trị của các cột được lập chỉ mục.
	- Ví dụ: Xét một bảng có tên "Orders", với các cột OrderID, CustomerID, OrderDate, và OrderTotal. Có thể tạo chỉ mục trên cột OrderTotal bằng lệnh SQL sau:
	```
	CREATE INDEX idx_OrderTotal ON Orders(OrderTotal);
	```
	- ![images](./images/d-308.png)
	- ![images](./images/d-309.png)
	- ![images](./images/d-310.png)
	- Sử dụng kiểu dữ liệu phù hợp
	- Việc lựa chọn kiểu dữ liệu phù hợp có thể cải thiện hiệu suất truy vấn. Sử dụng các kiểu dữ liệu nhỏ hơn như int thay vì kiểu dữ liệu lớn hơn như bigint có thể giúp giảm dung lượng đĩa cần thiết để lưu trữ dữ liệu, dẫn đến xử lý truy vấn nhanh hơn.
	- Tránh sử dụng **SELECT ***
	- Việc sử dụng **SELECT *** có thể khiến truy vấn lấy dữ liệu không cần thiết, làm chậm hiệu suất. Thay vào đó, hãy chọn chỉ những cột thực sự cần thiết.
	- Ví dụ:
	```
	SELECT name, email FROM Customers;
	```
	- Điều này giúp tối ưu hóa truy vấn và cải thiện tốc độ xử lý.

- Sử dụng thủ tục lưu trữ (Stored Procedures)
	- Thủ tục lưu trữ là các truy vấn được biên dịch sẵn và lưu trữ trong cơ sở dữ liệu. Chúng có thể cải thiện hiệu suất bằng cách giảm lưu lượng mạng và tăng khả năng tái sử dụng kế hoạch thực thi.
	- Tạo Stored Procedure
	```
	CREATE PROCEDURE GetOrderTotals
	@StartDate DATE,
	@EndDate DATE
	AS
	BEGIN
	SELECT CustomerID, SUM(OrderTotal) AS TotalSpent
	FROM Orders
	WHERE OrderDate BETWEEN @StartDate AND @EndDate
	GROUP BY CustomerID;
	END;
	```
	- Stored Procedure "GetOrderTotals" giúp truy vấn chạy nhanh hơn khi tìm tổng tiền đã chi theo khách hàng.
	- Gọi Stored Procedure
	- Thay vì viết lại truy vấn mỗi lần, ta có thể gọi Stored Procedure:
	```
	EXEC GetOrderTotals '2020-01-01', '2020-12-31';
	```
	- ![images](./images/d-311.png)
	- ![images](./images/d-312.png)

- Sử dụng bảng tạm (Temp Tables)
	- Bảng tạm được sử dụng để lưu trữ kết quả trung gian trong một truy vấn SQL. Khi sử dụng bảng tạm, SQL Server có thể giảm lượng dữ liệu cần xử lý, giúp cải thiện hiệu suất truy vấn.
	- Ví dụ: Xét truy vấn SQL sau:
	```
	SELECT CustomerID, SUM(OrderTotal)
	FROM Orders
	WHERE OrderDate BETWEEN '2020-01-01' AND '2020-12-31'
	GROUP BY CustomerID;
	```
	- Có thể sử dụng bảng tạm để lưu trữ kết quả trung gian bằng cách dùng các lệnh SQL sau:
	```
	CREATE TABLE #tempOrders
	(
	  CustomerID INT,
	  OrderTotal DECIMAL(10,2)
	);

	INSERT INTO #tempOrders
	SELECT CustomerID, OrderTotal
	FROM Orders
	WHERE OrderDate BETWEEN '2020-01-01' AND '2020-12-31';

	SELECT CustomerID, SUM(OrderTotal)
	FROM #tempOrders
	GROUP BY CustomerID;
	```
	- Trong ví dụ này, tạo một bảng tạm có tên #tempOrders để lưu trữ kết quả của truy vấn "SELECT CustomerID, OrderTotal FROM Orders WHERE OrderDate BETWEEN '2020-01-01' AND '2020-12-31'." Ở bước cuối cùng, sử dụng bảng tạm để nhóm kết quả theo CustomerID và tính tổng giá trị đơn hàng (OrderTotal).
	Bảng tạm giúp giảm khối lượng dữ liệu phải xử lý, tối ưu hóa truy vấn và cải thiện hiệu suất. 
	- ![images](./images/d-313.png)

### 2.8 Transaction và Log 
- Transaction
	- Các lệnh cơ bản của giao dịch trong SQL
		- BEGIN TRANSACTION hoặc BEGIN TRAN → Bắt đầu một giao dịch mới.
		- COMMIT TRANSACTION hoặc COMMIT TRAN → Kết thúc giao dịch thành công, xác nhận và lưu tất cả thay đổi vào cơ sở dữ liệu.
		- ROLLBACK TRANSACTION hoặc ROLLBACK TRAN → Hủy bỏ giao dịch, hoàn tác tất cả các thao tác đã thực hiện, đưa dữ liệu về trạng thái trước giao dịch.
	- Các loại giao dịch trong SQL Server: SQL Server hỗ trợ ba loại giao dịch cơ bản:
		- Giao dịch tường minh (Explicit Transactions): Như tên gọi, giao dịch này phải được bắt đầu rõ ràng bằng lệnh BEGIN TRANSACTION và kết thúc rõ ràng bằng COMMIT TRANSACTION hoặc ROLLBACK TRANSACTION. Điều này có nghĩa là nhà phát triển SQL Server kiểm soát thời điểm xác nhận hoặc hủy bỏ giao dịch, đảm bảo dữ liệu được lưu đúng lúc.
		- Giao dịch tự động (Autocommit Transactions): Trong trường hợp này, nhà phát triển không kiểm soát thời điểm bắt đầu hoặc kết thúc giao dịch. Mỗi câu lệnh T-SQL được coi là một giao dịch riêng biệt, SQL Server tự động bắt đầu và xác nhận giao dịch mà không cần lệnh BEGIN TRANSACTION. SQL Server luôn đảm bảo có thể hoàn tác thay đổi nếu xảy ra lỗi, ngay cả khi giao dịch không được khai báo tường minh.
		- Giao dịch ngầm định (Implicit Transactions): SQL Server tự động bắt đầu một giao dịch khi có thay đổi trên cơ sở dữ liệu và giữ trạng thái giao dịch mở cho đến khi nó được kết thúc rõ ràng. Sau khi giao dịch hiện tại kết thúc, một giao dịch mới lại được bắt đầu tự động. Hành vi này không phải mặc định, nó cần được kích hoạt bằng lệnh SET IMPLICIT_TRANSACTIONS ON. Tuy nhiên, tính năng này hiếm khi được sử dụng, chủ yếu để tương thích với các hệ quản trị cơ sở dữ liệu khác (RDBMS). Một số nhà phát triển không nhận ra giao dịch ngầm định đang hoạt động và nghĩ rằng họ không cần tự commit giao dịch, dẫn đến sai sót.
	- Ví dụ về Explicit Transactions:
	- Trường hợp success
	```
	BEGIN TRANSACTION;
	-- Deduct 1000 from Nguyen Van A’s account
	UPDATE BankAccounts SET Balance = Balance - 1000 WHERE AccountID = 1;
	-- Add 1000 to Tran Thi B’s account
	UPDATE BankAccounts SET Balance = Balance + 1000 WHERE AccountID = 2;
	-- Log transaction details
	INSERT INTO Transactions (AccountID, Amount, TransactionType)
	VALUES (1, -1000, 'Transfer'), (2, 1000, 'Transfer');
	-- Confirm and save changes
	COMMIT TRANSACTION;
	-- Verify balances
	SELECT * FROM BankAccounts;
	SELECT * FROM Transactions;
	```
	- ![images](./images/d-329.png)
	- Trường hợp fall -> Rollback 
	```
	BEGIN TRANSACTION;

	-- Check if there are enough funds
	DECLARE @CurrentBalance DECIMAL(10,2);
	SELECT @CurrentBalance = Balance FROM BankAccounts WHERE AccountID = 1;

	IF @CurrentBalance < 5000 
	BEGIN
	PRINT 'Error: Insufficient funds!';
	ROLLBACK TRANSACTION;
	END
	ELSE
	BEGIN
	-- Deduct money
	UPDATE BankAccounts SET Balance = Balance - 5000 WHERE AccountID = 1;

	-- Add money to recipient account
	UPDATE BankAccounts SET Balance = Balance + 5000 WHERE AccountID = 2;

	-- Log transaction
	INSERT INTO Transactions (AccountID, Amount, TransactionType)
	VALUES (1, -5000, 'Transfer'), (2, 5000, 'Transfer');

	-- Commit transaction
	COMMIT TRANSACTION;
	END

	-- Verify balances
	SELECT * FROM BankAccounts;
	SELECT * FROM Transactions;
	```
	- ![images](./images/d-330.png)
	- ![images](./images/d-331.png)

	- Sử dụng với `Save Point`
	```
	BEGIN TRANSACTION;

	-- Update account balances
	UPDATE BankAccounts SET Balance = Balance - 500 WHERE AccountID = 1;
	SAVE TRANSACTION FirstUpdate;

	UPDATE BankAccounts SET Balance = Balance + 500 WHERE AccountID = 2;
	SAVE TRANSACTION SecondUpdate;

	-- Simulate an error in a third update
	IF 1=1 -- Simulating failure
	BEGIN
	PRINT 'Error detected! Rolling back only the second update.';
	ROLLBACK TRANSACTION SecondUpdate;
	END

	-- Commit remaining changes
	COMMIT TRANSACTION;

	-- Check balances after partial rollback
	SELECT * FROM BankAccounts;
	SELECT * FROM Transactions;
	```
	- ![images](./images/d-332.png)
	- ![images](./images/d-333.png)
- Lock
	- Locking là cơ chế mà SQL Server sử dụng để kiểm soát việc truy cập vào các tài nguyên như bảng, hàng, hoặc trang dữ liệu khi có nhiều transaction đang thực hiện đồng thời đảm bảo rằng các phiên (session) không đọc hoặc ghi vào các tài nguyên đang được giao dịch khác sử dụng.
		- Lock cấp độ hàng (Row Lock): Khóa 1 row dữ liệu.
		- Lock cấp độ trang (Page Lock): Khóa 1 page dữ liệu (bao gồm nhiều row).
		- Lock cấp độ bảng (Table Lock): Khóa toàn bộ bảng dữ liệu.
		- Lock cấp độ database (Database Lock): Khóa database.
		- Lock cấp độ file (File Lock): Khóa toàn bộ file dữ liệu.
		- Lock cấp độ phân đoạn (Extent Lock): Khóa một phần của file dữ liệu.
		- Lock cấp độ filegroup (Filegroup Lock): Khóa một filegroup.
		- Lock cấp độ đối tượng (Object Lock): Khóa một đối tượng cụ thể như bảng, view, hoặc stored procedure.
	- SQL Server cung cấp một số loại khóa chính:
		- Shared Lock (S): Được sử dụng trong các truy vấn chỉ đọc (SELECT). Cho phép nhiều phiên truy cập nhưng không cho phép ghi.
		- Exclusive Lock (X): Dành cho các giao dịch ghi (INSERT, UPDATE, DELETE). Không cho phép bất kỳ truy cập nào từ các giao dịch khác.
		- Intent Lock (IX, IS): Chỉ báo hiệu rằng một số lượng khóa nhỏ hơn (như row lock) sẽ được giữ bên trong tài nguyên lớn hơn (như table lock).
		- Update Lock (U): Được sử dụng khi một transaction đọc dữ liệu với khả năng có thể cập nhật sau đó.
	- Ví dụ khoá bảng để update 
	```
	BEGIN TRANSACTION;
	-- Khóa toàn bộ bảng BankAccounts để cập nhật dữ liệu
	SELECT * FROM BankAccounts WITH (TABLOCKX);

	-- Cập nhật số dư
	UPDATE BankAccounts SET Balance = Balance - 1000 WHERE AccountID = 1;

	-- Giữ khóa để kiểm tra lỗi từ giao dịch khác
	WAITFOR DELAY '00:00:30';

	COMMIT TRANSACTION;
	```

	- Trong khi khoá thử query khác -> Bị lỗi không query được do lock 
	```
	SELECT TOP (1000) [AccountID]
	  ,[AccountHolder]
	  ,[Balance]
	FROM [DB_Test].[dbo].[BankAccounts]
	```
	- ![images](./images/d-334.png)
	- ![images](./images/d-335.png)
	
### 2.9 Bảo mật, mã hoá 
- SQL Server hỗ trợ nhiều phương thức mã hoá trong đó có Transparent Data Encryption(TDE),Column-Level Encryption (CLE) và mã hoá dữ liệu khi truyền sử dụng ssl/TLS
- Transparent Data Encryption(TDE)
	- TDE mã hóa toàn bộ cơ sở dữ liệu, bao gồm dữ liệu thực tế và các tệp nhật ký khi lưu trữ. Quá trình này hoạt động liền mạch trong nền mà không ảnh hưởng đến hiệu suất của chương trình người dùng.
	- TDE cung cấp một lớp bảo mật trong suốt cho cơ sở dữ liệu với những thay đổi nhỏ trong lược đồ cơ sở dữ liệu.
	- TDE hoạt động ở cấp độ tệp, mã hóa các tệp cơ sở dữ liệu trên ổ đĩa.
	- Quá trình mã hóa diễn ra tự động khi dữ liệu được đọc hoặc ghi vào cơ sở dữ liệu.
	- TDE sử dụng khóa đối xứng để bảo vệ cơ sở dữ liệu.
	- TDE chỉ khả dụng ở bản trả phí của SQL Server 
	- Các bước triển khai TDE
	- Ví dụ với data 
	```
	CREATE TABLE Student (
	StudentID INT PRIMARY KEY, 
	StudentName VARCHAR(30) NOT NULL, 
	RollNumber VARCHAR(10) NOT NULL
	);

	INSERT INTO Student VALUES
	(1, 'Ram', 1234),
	(2, 'Shyam', 4321),
	(3, 'Hari', 4554),
	(4, 'Om', 7896);
	```

	- Tạo khóa chính của cơ sở dữ liệu: Khóa chính bảo vệ hệ thống mã hóa.
	```
	USE dba;
	GO
	CREATE MASTER KEY ENCRYPTION BY PASSWORD = 'ABC@123';
	GO
	```
	- Tạo chứng chỉ bảo mật: Chứng chỉ được sử dụng để bảo vệ các khóa mã hóa.
	```
	USE dba;
	GO
	CREATE CERTIFICATE TDE_Certificate
	WITH SUBJECT = 'Certificate for TDE';
	GO
	```

	- Tạo khóa mã hóa: Xác định khóa mã hóa cơ sở dữ liệu với thuật toán cụ thể
	```
	USE dba;
	GO
	CREATE DATABASE ENCRYPTION KEY
	WITH ALGORITHM = AES_256
	ENCRYPTION BY SERVER CERTIFICATE TDE_Certificate;
	```
	- Bật chế độ mã hóa: Cấu hình cơ sở dữ liệu để bật mã hóa bằng lệnh sau
	```
	ALTER DATABASE dba
	SET ENCRYPTION ON;
	```
	- Sau khi mã hóa, cơ sở dữ liệu đã được bảo vệ khỏi truy cập trái phép.

- Mã hóa cấp cột (CLE)
	- Phương pháp này tập trung vào việc mã hóa các cột cụ thể trong bảng thay vì toàn bộ bảng hoặc cơ sở dữ liệu. Điều này cho phép tổ chức chọn lọc bảo mật dữ liệu quan trọng.
	- CLE hữu ích khi làm việc với cơ sở dữ liệu chứa cả dữ liệu nhạy cảm và dữ liệu không nhạy cảm.
	- CLE hoạt động trên cấp độ tệp, mã hóa dữ liệu trên ổ đĩa.
	- CLE sử dụng khóa bất đối xứng để mã hóa dữ liệu.
	- Ví dụ 
		- Tạo khóa chính của cơ sở dữ liệu
		```
		USE Student;
		GO
		CREATE MASTER KEY ENCRYPTION BY PASSWORD = '123@4321';
		```
		- ![images](./images/d-375.png)

		- Tạo chứng chỉ tự ký
		```
		USE Student;
		GO
		CREATE CERTIFICATE Certificate_test
		WITH SUBJECT = 'Protect my data';
		GO
		```
		- ![images](./images/d-376.png)

		- Cấu hình khóa đối xứng
		```
		CREATE SYMMETRIC KEY SymKey_test
		WITH ALGORITHM = AES_256
		ENCRYPTION BY CERTIFICATE Certificate_test;
		```
		- ![images](./images/d-377.png)

		- Mã hóa các cột cụ thể
		```
		ALTER TABLE Student
		ADD RollNumber_encrypt varbinary(MAX);
		```
		- ![images](./images/d-378.png)

		- Sau khi mã hóa, cột RollNumber_Encrypted sẽ chứa các giá trị đã được mã hóa, khiến chúng không thể đọc được đối với người dùng không có quyền truy cập hợp lệ.
		- User không hợp lệ (không có quyền truy cập vào khóa giải mã)
		```
		SELECT StudentID, StudentName, RollNumber_encrypt
		FROM Student;
		```
		- ![images](./images/d-379.png)

		- User hợp lệ (có quyền truy cập khóa giải mã)
		```
		OPEN SYMMETRIC KEY SymKey_test
		DECRYPTION BY CERTIFICATE Certificate_test;
		SELECT StudentID, StudentName, 
		CONVERT(VARCHAR(10), DecryptByKey(RollNumber_encrypt)) AS RollNumber
		FROM Student;
		```
		- ![images](./images/d-380.png)
- SSL/TLS
	- Sinh chứng chỉ từ IIS 
	- ![images](./images/d-385.png)
	- ![images](./images/d-384.png)
	- Mở trình quản lý cert -> Cấp quyền cho SQL Server 
	- Tại cửa sổ run
	```
	certlm.msc 
	```
	- ![images](./images/d-386.png)
	- Chọn add và thêm `NT Service\MSSQL$SQLEXPRESS` -> OK
	- ![images](./images/d-387.png)
	- ![images](./images/d-388.png)
	- Cấu hình bật force encrypt
	- Tại cửa sổ run
	```
	SQLServerManager16.msc 
	```
	- Phần protocols 
	- ![images](./images/d-389.png)
	- Force encrypt
	- ![images](./images/d-390.png)
	- Thêm chứng chỉ 
	- ![images](./images/d-391.png)
	- Restart
	- ![images](./images/d-392.png)
	- Kiểm tra 
	- Trước TLS: Gói tin hiển thị rõ, kiểm tra encrypt = false 
	```
	SELECT session_id, encrypt_option 
	FROM sys.dm_exec_connections;
	```
	- ![images](./images/d-381.png)
	- ![images](./images/d-382.png)
	- Sau TLS: Login Phần Encrypt chọn Mandary và tích Trust do là cert tự ký
	- ![images](./images/d-393.png)
	- ![images](./images/d-394.png)
	- ![images](./images/d-395.png)

- SQL Server
	- SQL Server Auditing là quá trình theo dõi và ghi lại các hoạt động xảy ra trên máy chủ SQL nhằm phát hiện các mối đe dọa bảo mật, tuân thủ quy định và duy trì tính toàn vẹn của hệ thống. Audit giúp quản trị viên giám sát các thay đổi cấu hình, hành động của người dùng và các sự kiện bảo mật.
	- Server-Level Auditing: Server-level auditing giám sát hoạt động diễn ra trên toàn bộ SQL Server, bao gồm đăng nhập, thay đổi cấu hình và sự kiện bảo mật.
		- Các nhóm hành động audit phổ biến ở cấp độ máy chủ:
			- AUDIT_CHANGE_GROUP: Giám sát thay đổi trong cấu hình audit.
			- APPLICATION_ROLE_CHANGE_PASSWORD_GROUP: Theo dõi thay đổi mật khẩu của role ứng dụng.
			- SECURITY_CHANGE_GROUP: Ghi lại các thay đổi liên quan đến bảo mật hệ thống.
	- Database-Level Auditing: Database-level auditing theo dõi hoạt động bên trong từng cơ sở dữ liệu riêng biệt, bao gồm truy cập dữ liệu, thay đổi bảng, cập nhật lược đồ và sự kiện đăng nhập vào database.
	- Các nhóm hành động audit phổ biến ở cấp độ cơ sở dữ liệu:
		- DATABASE_OPERATION_GROUP: Ghi lại các thao tác với database.
		- DATABASE_LOGON_GROUP: Theo dõi các lần đăng nhập vào database.
		- SCHEMA_OBJECT_ACCESS_GROUP: Giám sát quyền truy cập vào bảng, lược đồ và các đối tượng cơ sở dữ liệu.
	- Cấu hình 
- Server Audit 
	- Mở Object Explorer, mở rộng Security → Audits → New Audit....
	- ![images](./images/d-428.png)
	- Cấu hình Audit:
		- Audit name: Đặt tên audit.
		- Queue delay: Xác định thời gian trễ xử lý (mặc định 1000 ms).
		- On Audit Log Failure: Chọn Continue, Shut down server, hoặc Fail operation.
		- Audit Destination: Chọn File, Windows Application Log, hoặc Windows Security Log.
		- Thiết lập file log:
			- File path: Chọn nơi lưu file audit. Có thể chọn đẩy về Logs Applicaion hoặc Security của Windows 
			- Maximum files / Maximum file size: Giới hạn số file và kích thước file audit.
		- Lọc dữ liệu audit (tùy chọn): Nhập predicate (WHERE clause) để chỉ audit các sự kiện cụ thể.
		- ![images](./images/d-429.png)
		- Xác nhận: Nhấn OK để tạo audit.
		- Enable Audit bằng cách click chuột phải vào audit mới tại chọn Enable
		- ![images](./images/d-430.png)
		- ![images](./images/d-431.png)
		- Audit sẽ bắt đầu ghi lại hoạt động theo cấu hình đã thiết lập.
		- Để xem log audit click chuột phải vào audit cần xem và chọn View 
		- ![images](./images/d-432.png)
			- Note: Nếu gặp lỗi `Item has already been added. Key in dictionary: 'MNDO' Key being added: 'MNDO'`
			- ![images](./images/d-433.png)
			- Tải và cài đặt bản vá lỗi [SQL 2022 update package (KB5026717)](https://www.microsoft.com/en-us/download/details.aspx?id=105013)
			- ![images](./images/d-434.png)
		- ![images](./images/d-435.png)
	- Audit Specification: Audit Action cụ thể 
		- Mở Object Explorer, mở rộng Security → Server Audit Specifications → New Server Audit Specification....
		- ![images](./images/d-436.png)
		- Cấu hình Server Audit Specification:
		- Name: Đặt tên cho audit specification.
		- Audit: Chọn một server audit đã tồn tại.
		- ![images](./images/d-437.png)
		- Audit Action Type: Xác định loại sự kiện audit ở cấp độ máy chủ.
		- Object Schema & Object Name: Chọn đối tượng cần audit (chỉ áp dụng cho audit actions).
		- Principal Name: Lọc audit theo tài khoản người dùng liên quan.
		- Tùy chỉnh đối tượng audit: Nhấn (...) để mở Select Objects và chọn đối tượng cần audit.
		- Xác nhận: Nhấn OK để tạo Server Audit Specification
		- ![images](./images/d-438.png)		
		- ![images](./images/d-439.png)

	- Database Audit 
		- Mở Object Explorer, mở rộng database, chọn Security → Database Audit Specifications → New Database Audit Specification.
		- ![images](./images/d-440.png)
		- Cấu hình Database Audit Specification:
		- Name: Đặt tên audit specification.
		- Audit: Chọn một server audit đã tồn tại.
		- Audit Action Type: Xác định nhóm hành động audit ở cấp độ database.
		- Object Schema & Object Name: Chọn đối tượng cần audit (chỉ áp dụng cho audit actions).
		- Principal Name: Lọc audit theo tài khoản người dùng liên quan.
		- Tùy chỉnh đối tượng audit: Nhấn (...) để mở Select Objects và chọn đối tượng cần audit.
		- ![images](./images/d-441.png)
		- Xác nhận: Nhấn OK để tạo Database Audit Specification.
		- ![images](./images/d-442.png)
		- ![images](./images/d-443.png)
		- Audit sẽ ghi lại các sự kiện theo cấu hình đã thiết lập. 
		- ![images](./images/d-444.png)
	- Có thể audit sử dụng T-SQL 
	- Server Audit 
	```
	-- Creates a server audit called "Audit-Demo" with a binary file as the target and no options.  
	CREATE SERVER AUDIT Audit-Demo  
    TO FILE ( FILEPATH ='E:\SQLAudit\' )
	```
	- Server specification audit 
	```
	/*Creates a server audit specification called "Audit-Demo_Specification" that audits failed logins for the SQL Server audit "Audit-Demo" created above. 	*/  

	CREATE SERVER AUDIT SPECIFICATION Audit-Demo_Specification  
	FOR SERVER AUDIT Audit-Demo  
		ADD (FAILED_LOGIN_GROUP);  
	GO  
	-- Enables the audit.   

	ALTER SERVER AUDIT Audit-Demo  
	WITH (STATE = ON);  
	GO
	```
	- Database Specification Audit 
	```
	USE DB_Test;
	GO

	-- Create the database audit specification.
	CREATE DATABASE AUDIT SPECIFICATION Audit_Pay_Tables
	FOR SERVER AUDIT Audit-Demo ADD (
		SELECT, INSERT ON HumanResources.EmployeePayHistory BY dbo
	)
	WITH (STATE = ON);
	GO
	```

## 3. Các mô hình HA, cluster, replica 
### 3.1 SQL Server Replica 
- SQL server replication là một bộ các giải pháp cho phép sao chép và phân phối cơ sở dữ liệu giữa các SQL server và đồng bộ chúng nhằm duy trì tính nhất quán dữ liệu.
- Sử dụng replication, chúng ta có thể phân phối dữ liệu đến nhiều SQL server khác nhau hay truy cập từ xa thông qua mạng cục bộ hay internet. Replication cũng nâng cao tính thực hiện hay phân phối CSDL trên nhiều Server với nhau.
- Thuật ngữ liên quan tới replication trong SQL Server
	- Publisher: Là một server tạo dữ liệu để nhân bản đến các server khác. Nó xác định dữ liệu nào được nhân bản, dữ liệu nào thay đổi và duy trì những thông tin về các công bố tại site đó.
	- Subscriber: Là một server lưu giữ bản sao và nhận các tác vụ cập nhật. Một Subscriber có thể là một Publisher của các Subscriber khác.
	- Distributor: Là một server chứa CSDL phân tán (distribution database) và lưu trữ metadata, history data và transaction.
	- Article: Là một bảng dữ liệu, một phần dữ liệu hay những đối tượng CSDL sẽ nhân bản. Một Article có thể là một bảng dữ liệu bao gồm column và row hay một stores produre…
	- Publication: Là tập của một hay nhiều Article từ một CSDL. Chúng được nhóm lại với nhau một cách hệ thống thành một tâp dữ liệu cùng với các đối tượng CSDL mà bạn muốn nhân bản trên nhiều Server với nhau.
- SQL Server có 4 loại replication:
	- Snapshot Replication – Sao chép toàn bộ dữ liệu tại một thời điểm, phù hợp khi dữ liệu ít thay đổi.
	- Transactional Replication – Đồng bộ dữ liệu gần như thời gian thực, lý tưởng cho hệ thống cần cập nhật liên tục.
	- Merge Replication – Cho phép cả publisher và subscriber thay đổi dữ liệu, phù hợp với môi trường phân tán.
	- Peer-to-Peer Replication – Các máy chủ đồng bộ dữ liệu lẫn nhau, tăng khả năng chịu lỗi và hiệu suất.
- Ví dụ cấu hình SQL Server Replication Mode 
	- Triển khai trên 2 host Windows server 2022 R2 Datacenter có cài đặt SQL Server 2022 Enterprise
	- Host 1
		- IP address: 192.168.50.132
		- Hostname: SQL-WIN
		- MS SQL Server Instance ID: SQLEXPRESS1
	- Host 2
		- IP address: 192.168.50.133
		- Hostname: SQL-WIN-2
		- MS SQL Server Instance ID: SQLEXPRESS2
	- Trên Host1
	- Cấu hình Distribution
		- Click chuột phải vào Replication -> Configure Distribution
		- [images](./images/d-474.png)
		- Tại Configure Distribution Wizard -> Next
		- [images](./images/d-475.png)
		- Chọn Next. Cấu hình host 1 là Distributer
		- [images](./images/d-476.png)
		- Cấu hình thư mục lưu snapshot
		- [images](./images/d-477.png)
		- Cấu hình tên, thư mục lưu database
		- [images](./images/d-478.png)
		- Next 
		- [images](./images/d-479.png)
		- Tích chọn cấu hình Distribution và next
		- [images](./images/d-480.png)
		- Xác nhận thông số cấu hình và chọn Finish 
		- [images](./images/d-481.png)
		- Tạo thành công 
		- [images](./images/d-482.png)

	- Tạo Publication 
		- Mở rộng menu Replication, click chuột phải `Local Publications` và chọn `New Publication`
		- [images](./images/d-483.png)
		- Tại wizard chọn next
		- [images](./images/d-484.png)
		- Chọn Database cần replication 
		- [images](./images/d-485.png)
		- Chọn kiểu replication
		- [images](./images/d-486.png)
		- Cấu hình bảng, thủ tục, script replication 
		- [images](./images/d-487.png)
		- Cấu hình filter không cấu hình gì -> Next
		- [images](./images/d-488.png)
		- Tích chọn tạo snapshot và chọn Next
		- [images](./images/d-489.png)
		- Tại phần Agent Security -> Chọn SecuritySettings -> Điền account để chạy agent ở đây sử dụng luôn account Admin 
		- [images](./images/d-490.png)
		- Tích chọn tạo Publication và Next 
		- [images](./images/d-491.png)
		- Xác nhận lại thông tin cấu hình và Finish 
		- [images](./images/d-492.png)
		- Publication được tạo thành công
		- [images](./images/d-493.png)

	- Tạo Subscription
		- Bản sao MS SQL Server có thể là bản sao kéo hoặc đẩy. (pull or push)
		- Trường hợp cấu hình push cần cấu hình Subscriber chạy agents trên máy chứa chính chứa data 
		- Trường hợp cấu hình pull cần cấu hình Subscriber chạy agents trên máy chứa phụ nơi mà data replica được lưu
		- Ở đây cấu hình push thực hiện tạo  Subscription trên máy host 1
		- Mở rộng menu Replication, click chuột phải `Local Subscriptions ` và chọn `New Subscriptions `
		- [images](./images/d-494.png)
		- Tại wizard chọn next
		- [images](./images/d-495.png)
		- Chọn Server chứa Publisher
		- [images](./images/d-496.png)
		- Chọn Publisher
		- [images](./images/d-498.png)
		- Chọn run agents kiểu push 
		- [images](./images/d-499.png)
		- Bỏ tích Subscriber mặc định, chọn Add Subscriber (host2)
		- [images](./images/d-500.png)
		- Điền thông tin đăng nhập sqlserver trên máy 2 và connect 
		- [images](./images/d-501.png)
		- Chọn New Database, data replication được lưu ở db này 
		- [images](./images/d-502.png)
		- Cấu hình tên và thông số 
		- [images](./images/d-503.png)
		- Cấu hình xong lưu về `DB_Test_Clone`, Chọn Next
		- [images](./images/d-504.png)
		- Tại phần Agent Security -> Chọn SecuritySettings -> Điền account để chạy agent ở đây sử dụng luôn account Admin 
		- [images](./images/d-505.png)
		- Chọn Run continuously -> Next 
		- [images](./images/d-506.png)
		- Chọn immediately -> Next
		- [images](./images/d-507.png)
		- Tích chọn tại Subscription
		- [images](./images/d-508.png)
		- Kiểm tra lại thông tin cấu hình và Finish 
		- [images](./images/d-509.png)
		- Tạo Subscription thành công 
		- [images](./images/d-510.png)
		- Tại phần SQL Agent nhận thấy các job replication đang chạy 
		- [images](./images/d-511.png)
	- Kiểm tra trạng thái. 
		- Mở rộng menu Replication, click chuột phải `Local Publications` và chọn `Launch Replication Monitor`
		- [images](./images/d-512.png)
		- [images](./images/d-513.png)
		- Kiểm tra đồng bộ data 
			- Query data trên máy 1 
			- [images](./images/d-514.png)
			- Query data trên máy 2 thu được kết quả-> đã đồng bộ 
			- [images](./images/d-515.png)

### 3.2 SQL Failover Cluster 
- SQL Server Failover Cluster là một giải pháp có tính sẵn sàng cao (HA - High Availability), giúp đảm bảo hệ thống cơ sở dữ liệu hoạt động liên tục ngay cả khi một máy chủ gặp sự cố.
- Cấu trúc của SQL Server Failover Cluster: Một cụm Failover Cluster bao gồm:
	- Nút chính (Primary Node): Máy chủ SQL Server đang hoạt động.
	- Nút dự phòng (Secondary Node): Máy chủ SQL Server chờ sẵn để tiếp quản khi nút chính gặp lỗi.
	- Shared Storage: Dữ liệu được lưu trữ trên hệ thống chung (SAN, NAS) để đảm bảo tính nhất quán.
	- Quorum: Cơ chế xác định số lượng nút cần thiết để duy trì hoạt động của cụm.
- Triển khai trên 3 máy 1 DC 2 Node SQLSERVER 

| Tên Máy Chủ             | Địa Chỉ IP       | Hệ Điều Hành         |
|------------------------|------------------|-----------------------|
| dc.annt.cloud          | 192.168.50.10    | Windows Server 2022   |
| sql-win.annt.cloud     | 192.168.50.3     | Windows Server 2022   |
| sql-win-2.annt.cloud   | 192.168.50.4     | Windows Server 2022   |

- 2 node đã join domain annt.cloud
- Trên máy DC
	- Cài đặt iSCSI Target Server. Sau đó tạo ra các iSCSI Virtual Disks để cho phép các nodes sql kết nối, lưu trữ dữ liệu thông qua giao thức iSCSI. 
	- Trong Server Manager -> Add Roles and Features -> iSCSI target server 
	- ![images](./images/d-560.png)
	- ![images](./images/d-561.png)
	- ![images](./images/d-562.png)
	- ![images](./images/d-563.png)
	- Tạo iSCSI Virtual Disk. Tại ServerManager -> File and Storage Services 
	- ![images](./images/d-564.png)
	- Phần iscsi click tạo mới 
	- ![images](./images/d-565.png)
	- Chọn ổ cần tạo 
	- ![images](./images/d-566.png)
	- Cấu hình tên, dung lượng 
	- ![images](./images/d-567.png)
	- ![images](./images/d-568.png)
	- Chọn new iscsi target 
	- ![images](./images/d-569.png)
	- Đặt tên target 
	- ![images](./images/d-570.png)
	- Cấu hình ip có thể truy cập sử dụng ở đây cấu hình thêm IP 2 node SQLServer 
	- ![images](./images/d-571.png)
	- ![images](./images/d-572.png)
	- Next, Create 
	- ![images](./images/d-573.png)
	- ![images](./images/d-574.png)
	- ![images](./images/d-575.png)
	- ![images](./images/d-576.png)
	- Thực hiện tương tự với các cluster disk khác thu được 
	- ![images](./images/d-551.png)

- Trên 2 Node SQL 
	- Kết nối iSCSI 
	- Thực hiện kết nối với target mới tạo : Server Manager -> Management -> iSCSI Init 
	- ![images](./images/d-577.png)
	- Điền IP máy DC và chọn Quick Connect 
	- ![images](./images/d-578.png)
	- Đã kết nối với target 
	- ![images](./images/d-579.png)
	- Cấu hình các Cluster Disk : Tools -> Computer Management -> Disk Management
	- Thực hiện Init Disk, tạo phân vùng 
	- ![images](./images/d-580.png)
	- ![images](./images/d-581.png)
	- ![images](./images/d-582.png)
	- Làm tương tự với các cluster disk khác thu được 
	- ![images](./images/d-552.png)
	- Cấu hình với Failover Cluster Manager
	- Thực hiện enable Failover Clustering: Trong Server Manager -> Add Roles and Features -> Failover Clustering
	- ![images](./images/d-583.png)
	- ![images](./images/d-584.png)
	- ![images](./images/d-585.png)
	- ![images](./images/d-586.png)
	- ![images](./images/d-587.png)
	- ![images](./images/d-588.png)
	- ![images](./images/d-589.png)
	- ![images](./images/d-591.png)
	- Thực hiện tạo Cluster : Tools -> Failover Cluster Manager
	- ![images](./images/d-592.png)
	- Click chuột phải vào Failover Cluster Manager -> Create Cluster 
	- ![images](./images/d-594.png)
	- Next 
	- ![images](./images/d-595.png)
	- Thêm hostname các node sql và chọn next
	- ![images](./images/d-597.png)
	- Bỏ qua validation test -> Next 
	- ![images](./images/d-598.png)
	- Đặt tên, cấu hình IP 
	- ![images](./images/d-599.png)
	- Xem lại cấu hình 
	- ![images](./images/d-600.png)
	- Cluster được tạo 
	- ![images](./images/d-601.png)
	- ![images](./images/d-602.png)
	- ![images](./images/d-603.png)
	- ![images](./images/d-604.png)

- Cài đặt SQL SERVER dạng Failover Cluster
	- Trên Node SQL 1 
		- Chạy file cài đặt SQL SERVER chọn cài mới node SQL Server Failover 
		- ![images](./images/d-605.png)
		- ![images](./images/d-606.png)
		- ![images](./images/d-607.png)
		- Cấu hình các service sử dụng 
		- ![images](./images/d-608.png)
		- Cấu hình tên Instance 
		- ![images](./images/d-609.png)
		- Next và chọn ClusterDisk lưu data 
		- ![images](./images/d-610.png)
		- ![images](./images/d-620.png)
		- Cấu hình IP (sử dụng IP riêng chưa từng sử dụng)
		- ![images](./images/d-621.png)
		- Cấu hình user khởi chạy ở đây sử dụng luôn tài khoản Administrator
		- ![images](./images/d-622.png)
		- Cấu hình pass sa 
		- ![images](./images/d-623.png)
		- Cài đặt thành công node sql 1
		- ![images](./images/d-624.png)
		- ![images](./images/d-625.png)
		- Kiểm tra trong trong phần Roles của failover cluster manager
		- ![images](./images/d-626.png)
	- Trên node SQL 2 
		- Thực hiện chạy file cài thêm node 
		- ![images](./images/d-627.png)
		- ![images](./images/d-628.png)
		- ![images](./images/d-629.png)
		- Cấu hình user khởi chạy ở đây sử dụng luôn tài khoản Administrator
		- ![images](./images/d-630.png)
		- Hoàn tất thêm node 
		- ![images](./images/d-631.png)
		- ![images](./images/d-632.png)
	- Kiểm tra 
		- Sử dụng SSMS kết nối vào SQL Server 
			- ![images](./images/d-633.png)
			- ![images](./images/d-634.png)
		- Kiểm tra hoạt động của Cluster SQL
			- Tại phần roles, SQLEXPRESS đang chạy tại node 1 `sql-win` thực hiện chuyển sang node 2 `sql-win-2`
			- ![images](./images/d-635.png)
			- ![images](./images/d-636.png)
			- ![images](./images/d-637.png)
			- ![images](./images/d-638.png)
			- Quá trình di chuyển thành công, SQL Server (MSSQLSERVER) đang có trạng thái Running và đang có Owner là node 2 `sql-win-2`
		- Kiểm tra quá trình Failover của Cluster SQL
			- Hiện tại MSSQLSERVER đang chạy trên node 2 `sql-win-2`. Thực hiện disable card mạng của Node 2:
			- ![images](./images/d-639.png)
			- Tại TAB Nodes, trạng thái của SQL02 đang là Down:
			- ![images](./images/d-640.png)
			- Cluster thực hiện chuyển lại sang node 1 
			- ![images](./images/d-641.png)
	- Chú ý: 
		- Với Windows Server 2022 trong trường hợp thêm Cluster có thể gặp lỗi không thể tạo được cluster mới.
			- Giải pháp: Tạo Cluster trước khi kết nối iSCSI, sau khi đã có cluster thực hiện kết nối iscsi, format disk và add vào cluster 
			- ![images](./images/d-551.png)
			- Cấu hình Disk Witness với các disk mới thêm
			- ![images](./images/d-643.png)
			- ![images](./images/d-644.png)
			- ![images](./images/d-645.png)
			- ![images](./images/d-646.png)
		- Với SQL Server có thể gặp lỗi `Error : "Microsoft Cluster Service (MSCS) cluster verification errors" failed. The cluster either has not been verified or there are errors or failures in the verification report. Refer to KB953748 or SQL server books online for more information"`
			- Giải pháp: Mở cửa sổ cmd -> cd tới thư mục chứa file setup SQLServer sử dụng các lệnh bỏ quá lỗi verify 
			- Cài node mới riêng lẻ 
			```
			Setup /SkipRules=Cluster_VerifyForErrors /Action=InstallFailoverCluster
			```
			- ![images](./images/d-647.png)
			- Thêm node vào hệ thống đã khởi tạo từ trước 
			```
			Setup /SkipRules=Cluster_VerifyForErrors /Action=AddNode
			```
			- ![images](./images/d-648.png)
	
### 3.3 SQL Always On availability groups
- Always On availability groups là một giải pháp sẵn sàng cao và khôi phục thảm họa cho SQL Server, thay thế database mirroring với độ ổn định và khả năng mở rộng tốt hơn. Nó giúp nhân bản cơ sở dữ liệu trên nhiều phiên bản, đảm bảo hệ thống luôn hoạt động và tự động chuyển đổi khi xảy ra sự cố.
- Tính năng & Lợi ích
	- Sẵn sàng cao: Duy trì nhiều bản sao để giảm thời gian ngừng hoạt động.
	- Khôi phục thảm họa: Cho phép sao chép dữ liệu sang site dự phòng và failover nhanh chóng.
	- Mở rộng quy mô: Hỗ trợ nhiều bản sao phụ, giúp tăng hiệu suất và dung lượng.
	- Giảm độ trễ: Chế độ synchronous commit đảm bảo dữ liệu được nhân bản tức thời.
	- Tối ưu hóa đọc: Bản sao phụ có thể cấu hình chỉ đọc để giảm tải cho bản chính.
	- Không cần lưu trữ chung: Linh hoạt hơn so với database mirroring.
	- Quản lý đơn giản: Microsoft cung cấp công cụ giám sát dễ sử dụng.
	- **Hỗ trợ cả synchronous & asynchronous commit, giúp điều chỉnh độ trễ failover.
- Thành phần chính
	- Availability Group: Nhóm chứa một hoặc nhiều database cùng bản sao.
	- Availability Replica: Máy chủ chứa bản sao database.
	- Primary Replica: Phiên bản chính, nơi xử lý cả đọc/ghi.
	- Secondary Replica: Phiên bản dự phòng, có thể trở thành primary khi failover.
	- Availability Mode: Chọn synchronous hoặc asynchronous để điều chỉnh việc nhân bản dữ liệu.
	- Listeners: Điểm kết nối chung cho ứng dụng.
- SQL Always On Availability Groups được Microsoft giới thiệu lần đầu tiên trong bản SQL Server 2012 Enterprise như một chức năng nâng cao nhằm tăng độ sẳn sàng cho hệ thống Database mà không cần sử dụng các Shared Storage từ SAN hay NAS như mô hình SQL Cluster truyền thống (Failover Clustering).
- Cấu hình 
	- Triển khai trên 3 máy 1 DC 2 Node SQLSERVER 

	| Tên Máy Chủ             | Địa Chỉ IP       | Hệ Điều Hành         |
	|------------------------|------------------|-----------------------|
	| dc.annt.cloud          | 192.168.50.10    | Windows Server 2022   |
	| sql-win.annt.cloud     | 192.168.50.3     | Windows Server 2022   |
	| sql-win-2.annt.cloud   | 192.168.50.4     | Windows Server 2022   |

- Mô Hình 
```mermaid
flowchart TB
    subgraph WSFC["WSFC: Windows Server Failover Cluster"]
        subgraph Region1["Region 1"]
            Primary["Primary Replica\nAG1"]
            Secondary1["Secondary Replica 1\nAG1 (HA)"]
        end

        subgraph Region2["Region 2"]
            Secondary2["Secondary Replica 2\nAG1 (DR)"]
        end
    end

    Users --> Listener["AG Listener"]
    Listener --> Primary

    Primary -->|Synchronous Commit| Secondary1
    Primary -.->|Asynchronous Commit| Secondary2

    %% Định nghĩa style
    classDef primary fill:#c6f6d5,stroke:#38a169,stroke-width:2px,color:#1a202c;
    classDef secondary fill:#bee3f8,stroke:#3182ce,stroke-width:2px,color:#1a202c;
    classDef dr fill:#fed7d7,stroke:#e53e3e,stroke-width:2px,color:#1a202c;
    classDef listener fill:#fefcbf,stroke:#d69e2e,stroke-width:2px,color:#1a202c;

    %% Gán style cho node
    class Primary primary;
    class Secondary1 secondary;
    class Secondary2 dr;
    class Listener listener;
```
- Điều kiện 
	- Các node SQLSERVER đều đã join vào domain `annt.cloud` do DC quản lý.
	- Các node đều đã cài SQLSERVER Standalone ở đây đã cài với instance ID: SQL_AOAG1 và SQL_AOAG2
	- ![images](./images/d-703.png) 
	- ![images](./images/d-704.png) 
	- Trên máy DC tạo 2 folder share 
		- SQLCluster : dùng làm witness storage cho failover 
		- SQL_AOAGDB : dùng làm nơi lưu log, backup data giữa các node 

- Cài đặt Windows Clustering trên các Cluster Nodes
	- Thực hiện enable Failover Clustering: Trong Server Manager -> Add Roles and Features -> Failover Clustering
	- ![images](./images/d-583.png)
	- ![images](./images/d-584.png)
	- ![images](./images/d-585.png)
	- ![images](./images/d-586.png)
	- ![images](./images/d-587.png)
	- ![images](./images/d-588.png)
	- ![images](./images/d-589.png)
	- ![images](./images/d-591.png)
	- Thực hiện tạo Cluster : Tools -> Failover Cluster Manager
	- ![images](./images/d-592.png)
	- Click chuột phải vào Failover Cluster Manager -> Create Cluster 
	- ![images](./images/d-594.png)
	- Next 
	- ![images](./images/d-595.png)
	- Thêm hostname các node sql và chọn next
	- ![images](./images/d-597.png)
	- Bỏ qua validation test -> Next
	- ![images](./images/d-598.png)
	- Đặt tên, cấu hình IP 
	- ![images](./images/d-599.png)
	- Xem lại cấu hình 
	- ![images](./images/d-600.png)
	- Cluster được tạo 
	- ![images](./images/d-601.png)
	- ![images](./images/d-602.png)
	- ![images](./images/d-603.png)
	- Cấu hình Witness
	- Tại phần cài đặt cluster 
	- ![images](./images/d-643.png)
	- Chọn `Select ..`
	- ![images](./images/d-705.png)
	- Chọn cấu hình dạng share file 
	- ![images](./images/d-706.png)
	- Điền đường dẫn thư mục share đã tạo 
	- ![images](./images/d-707.png)
	- Next để tạo witness 
	- ![images](./images/d-708.png)

- Cấu hình Always On Availability Groups trên các SQL Cluster Nodes
	- Trong SQL Server Configuration Manager của cả 2 node, trỏ phải lên SQL Server tương ứng rồi chọn Properties
	- ![images](./images/d-709.png)
	- Tại tab AlwaysOn High Availability tích Enable -> Apply -> OK 
	- ![images](./images/d-710.png)
	- Restart service để apply 
	- ![images](./images/d-712.png)
	- Backup database (database nằm trên node 1)
	- ![images](./images/d-714.png)
	- ![images](./images/d-715.png)
	- Tạo Always On Availability Groups
	- Tại phần Always On High Availability -> Availability Groups. Click chuột phải chọn `New Availability Groups Wizard`
	- ![images](./images/d-716.png)
	- ![images](./images/d-717.png)
	- Cấu hình tên và tích chọn `Data Level Health Dectection` 
	- ![images](./images/d-731.png)
	- Chọn DB cần thêm vào AOAG
	- ![images](./images/d-719.png)
	- Chọn Add Replica 
	- ![images](./images/d-720.png)
	- Login vào sqlserver node2 
	- ![images](./images/d-721.png)
	- Tích `Automatic Failover`, `Readable Secondary` = Yes
	- ![images](./images/d-722.png)
	- Chọn tab Listener: Cấu hình tên, port và IP 
	- ![images](./images/d-723.png)
	- Cấu hình nơi lưu DB và log: trỏ về thư mục share đã tạo từ trước 
	- ![images](./images/d-724.png)
	- Validation 
	- ![images](./images/d-725.png)
	- Cấu hình hoàn tất 
	- ![images](./images/d-727.png)

- Kiểm tra 
	- Kiểm tra nhận thấy quá trình synchronous diễn ra 
	- ![images](./images/d-728.png)
	- Kiểm tra Dashboard : Tại Always On Availability Groups -> Click chuột phải vào và chọn Show Dashboards 
	- ![images](./images/d-729.png)
	- ![images](./images/d-730.png)
	- Tại Failover Cluster Manager hiển thị Roles mới tạo, có thể chuyển qua lại giữa các node giống 
	- ![images](./images/d-732.png)
	- Thực hiện move sang node2 
	- ![images](./images/d-733.png)
	- ![images](./images/d-734.png)
	- Trên node 2 stop service SQL Server 
	- ![images](./images/d-735.png)
	- Qúa trình failover diễn ra chuyển sang node 1
	- ![images](./images/d-736.png)
	- ![images](./images/d-737.png)

- So sánh Always On Availability Groups và Failover Cluster Instances

| **Đặc điểm**                   | **Always On Availability Groups (AG)**              | **Failover Cluster Instances (FCI)** |
| ------------------------------ | --------------------------------------------------- | ------------------------------------ |
| **Yêu cầu WSFC**               | ✔️ Có                                               | ✔️ Có                                |
| **Cấp độ bảo vệ**              | Cơ sở dữ liệu                                       | Toàn bộ instance                     |
| **Kiểu lưu trữ**               | Không chia sẻ (Non-Shared)                          | Chia sẻ (Shared)                     |
| **Bản sao thứ cấp có thể đọc** | ✔️ Có                                               | ❌ Không                             |
| **Chế độ failover**            | Tự động, thủ công có kế hoạch, bắt buộc             | Tự động, thủ công có kế hoạch        |
| **Cơ chế khả dụng**            | **HA & DR** (High Availability & Disaster Recovery) | **Chỉ HA** (High Availability)       |
| **Tài nguyên failover**        | Chỉ cơ sở dữ liệu                                   | Toàn bộ instance với cơ sở dữ liệu   |
