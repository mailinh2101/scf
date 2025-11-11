# 🚀 Filament Admin Panel - Quick Start

## ⚡ 5 Phút Setup

### Bước 1: Truy cập Admin Panel
```
URL: http://localhost/admin
```

### Bước 2: Đăng nhập
```
Email:    admin@example.com
Password: password
```

### Bước 3: Thay đổi Password (Bắt buộc!)
1. Bấm vào avatar ở góc trên phải
2. Chọn "Edit profile" 
3. Đổi password
4. Bấm Save

## 📚 Các Tính năng Chính

### 🏠 Dashboard
Trang chủ admin với tổng quan thống kê

### 🛍️ Sản phẩm (Products)
- Tạo, cập nhật, xóa sản phẩm
- Upload hình ảnh
- Quản lý danh mục
- Xuất bản/ẩn sản phẩm

### 📝 Bài viết (Posts)
- Viết bài viết mới
- Soạn thảo với Rich Text Editor
- Upload ảnh nổi bật
- Lập lịch xuất bản

### 💼 Công việc (Jobs)
- Đăng tin tuyển dụng
- Nhập yêu cầu/lợi ích
- Quản lý trạng thái tin tuyển

### 📋 Đơn Ứng tuyển (Job Applications)
- Xem danh sách ứng tuyển
- Download CV
- Trả lời ứng viên

### 💬 Liên hệ (Contact Submissions)
- Xem thông điệp từ website
- Quản lý yêu cầu từ khách hàng

### ⚙️ Cài đặt (Site Settings)
- Quản lý thông tin website
- Lưu cấu hình chung

## 🔍 Thao tác Phổ biến

### Tìm kiếm
Bấm vào thanh tìm kiếm ở trên cùng để tìm kiếm nhanh

### Lọc
Bấm "Lọc" để hiển thị các tùy chọn lọc dữ liệu

### Sắp xếp
Bấm vào tiêu đề cột để sắp xếp (tăng/giảm)

### Xóa hàng loạt
1. Chọn các hàng bằng checkbox
2. Bấm "Xóa" ở cuối danh sách
3. Xác nhận

### Tùy chỉnh cột
Bấm icon ⚙️ ở góc trên phải để chọn cột hiển thị/ẩn

## 📞 Cần Giúp?

### Quên Password?
```bash
# Sử dụng Tinker để reset password
php artisan tinker
> $user = User::where('email', 'admin@example.com')->first()
> $user->update(['password' => Hash::make('newpassword')])
```

### Tạo Admin User Thêm
```bash
php artisan tinker
> User::create([
    'name' => 'New Admin',
    'email' => 'newadmin@example.com',
    'password' => Hash::make('password'),
    'is_admin' => true
])
```

### Xóa User
```bash
php artisan tinker
> User::where('email', 'email@example.com')->delete()
```

### Clear Cache
```bash
php artisan optimize:clear
```

## 🎨 Customization

### Thêm Trường Mới
1. Mở file Resource trong `app/Filament/Admin/Resources/`
2. Chỉnh sửa `form()` method để thêm input
3. Chỉnh sửa `table()` method để thêm cột hiển thị
4. Clear cache: `php artisan optimize:clear`

### Đổi Màu Sắc
Chỉnh sửa `app/Providers/Filament/AdminPanelProvider.php`:
```php
->colors([
    'primary' => Color::Blue,  // Thay đổi màu chính
])
```

### Thêm Logo
Chỉnh sửa `app/Providers/Filament/AdminPanelProvider.php`:
```php
->brandName('Your Company Name')
->logo(asset('images/logo.png'))
```

## 📖 Tài liệu

- **Setup Complete:** `FILAMENT_SETUP_COMPLETE_V2.md`
- **User Guide:** `FILAMENT_USER_GUIDE.md`
- **Setup Summary:** `FILAMENT_SETUP_SUMMARY.md`
- **Official Docs:** https://filamentphp.com/docs

## ✅ Verification

Kiểm tra cài đặt:
```bash
php verify-filament.php
```

Tất cả check phải pass ✅

---

**Bắt đầu quản lý nội dung ngay hôm nay! 🎉**
