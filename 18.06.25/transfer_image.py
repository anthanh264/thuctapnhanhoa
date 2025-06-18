import os
import shutil
import re

# Đường dẫn tới thư mục chứa ảnh gốc và thư mục đích
src_dir = r'C:\Users\an.nt\Documents\GitHub\thuctapnhanhoa\17.06.25\images'
dst_dir = r'C:\Users\an.nt\Documents\GitHub\thuctapnhanhoa\18.06.25\images'

# Tạo thư mục đích nếu chưa có
os.makedirs(dst_dir, exist_ok=True)

# Trích xuất danh sách ảnh từ file markdown
with open('0. Microsoft Exchange(Draft).md', 'r', encoding='utf-8') as f:
    content = f.read()

# Regex để tìm tất cả ảnh theo định dạng ![images](./images/...)
image_paths = re.findall(r'!\[images\]\((\.\/images\/[^\)]+)\)', content)

# Loại bỏ trùng lặp
image_paths = list(set(image_paths))

# Thực hiện sao chép
for rel_path in image_paths:
    filename = os.path.basename(rel_path)
    src_file = os.path.join(src_dir, filename)
    dst_file = os.path.join(dst_dir, filename)
    try:
        shutil.copy2(src_file, dst_file)
        print(f"✔ Copied: {filename}")
    except FileNotFoundError:
        print(f"❌ Missing: {filename}")

print(f"🔄 Hoàn tất sao chép {len(image_paths)} file.")