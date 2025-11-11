# 🎯 Hướng dẫn sử dụng Filament Admin Panel

## 📝 Tài khoản Admin Mặc định

```
Email: admin@example.com
Password: password
```

**⚠️ Lưu ý:** Vui lòng thay đổi password ngay sau khi đăng nhập lần đầu!

## 🔗 Các URL Quan Trọng

### Trang Chủ Admin
- **Dashboard:** `http://localhost/admin`
- **Login:** `http://localhost/admin/login`
- **Logout:** `http://localhost/admin/logout`

### Quản lý Sản phẩm
- **Danh sách:** `http://localhost/admin/products`
- **Tạo mới:** `http://localhost/admin/products/create`
- **Chỉnh sửa:** `http://localhost/admin/products/{id}/edit`

### Quản lý Bài viết
- **Danh sách:** `http://localhost/admin/posts`
- **Tạo mới:** `http://localhost/admin/posts/create`
- **Chỉnh sửa:** `http://localhost/admin/posts/{id}/edit`

### Quản lý Công việc
- **Danh sách:** `http://localhost/admin/jobs`
- **Tạo mới:** `http://localhost/admin/jobs/create`
- **Chỉnh sửa:** `http://localhost/admin/jobs/{id}/edit`

### Quản lý Đơn Ứng tuyển
- **Danh sách:** `http://localhost/admin/job-applications`
- **Tạo mới:** `http://localhost/admin/job-applications/create`
- **Chỉnh sửa:** `http://localhost/admin/job-applications/{id}/edit`

### Quản lý Liên hệ
- **Danh sách:** `http://localhost/admin/contact-submissions`
- **Tạo mới:** `http://localhost/admin/contact-submissions/create`
- **Chỉnh sửa:** `http://localhost/admin/contact-submissions/{id}/edit`

### Quản lý Cài đặt
- **Danh sách:** `http://localhost/admin/site-settings`
- **Tạo mới:** `http://localhost/admin/site-settings/create`
- **Chỉnh sửa:** `http://localhost/admin/site-settings/{id}/edit`

## 📊 Tính năng Chính

### Tìm kiếm
Sử dụng thanh tìm kiếm ở trên cùng của danh sách để tìm kiếm nhanh.

### Lọc
Nhấn vào icon "Lọc" để hiển thị các tùy chọn lọc dữ liệu.

### Sắp xếp
Nhấn vào tiêu đề cột để sắp xếp theo cột đó (tăng/giảm).

### Hành động Hàng loạt
Chọn nhiều hàng và sử dụng "Hành động Hàng loạt" để thực hiện hành động với nhiều mục cùng lúc.

### Upload Tệp
Khi tạo/chỉnh sửa:
- **Sản phẩm:** Upload hình ảnh sản phẩm
- **Bài viết:** Upload ảnh nổi bật
- **Đơn Ứng tuyển:** Upload tệp CV/Resume

## 🎨 Các Loại Trường

### TextInput
Nhập văn bản đơn giản (tên, tiêu đề, v.v.)

### Textarea
Nhập văn bản nhiều dòng (mô tả ngắn, yêu cầu, v.v.)

### RichEditor
Trình chỉnh sửa văn bản giàu có (nội dung bài viết, mô tả công việc, v.v.)
- Hỗ trợ: In đậm, Nghiêng, Danh sách, Liên kết, v.v.

### DateTimePicker
Chọn ngày và giờ (ngày xuất bản, ngày hết hạn, v.v.)

### FileUpload
Upload tệp (hình ảnh, PDF, v.v.)

### Toggle
Bật/tắt (xuất bản hay chưa, v.v.)

## 🔍 Thông tin Hiển thị

### Thay đổi cột hiển thị
Nhấn vào icon "⚙️" ở góc trên phải của bảng để chọn cột hiển thị/ẩn.

### Xem chi tiết
Nhấn vào dòng bất kỳ để xem chi tiết hoặc chỉnh sửa.

## ✏️ Chỉnh sửa Dữ liệu

1. Nhấn vào "Chỉnh sửa" (biểu tượng bút chì)
2. Chỉnh sửa thông tin
3. Nhấn "Lưu" ở cuối trang

## 🗑️ Xóa Dữ liệu

### Xóa một mục
1. Mở bản ghi để chỉnh sửa
2. Nhấn "Xóa" ở góc trên phải
3. Xác nhận xóa

### Xóa hàng loạt
1. Chọn các hàng bằng checkbox
2. Chọn "Xóa" trong "Hành động Hàng loạt"
3. Xác nhận xóa

## 🛠️ Các Mẹo

### Tự động tạo Slug
Slug được tự động tạo từ tiêu đề (nếu trống). Bạn có thể chỉnh sửa thủ công nếu cần.

### Tìm kiếm nâng cao
- Tìm kiếm theo nhiều trường
- Sử dụng lọc để thu hẹp kết quả
- Kết hợp tìm kiếm và lọc để kết quả chính xác

### Export dữ liệu
Bạn có thể sao chép dữ liệu từ bảng để paste vào Excel/Google Sheets.

## ❓ Câu Hỏi Thường Gặp

### Q: Quên password?
A: Liên hệ admin system để reset password. Hoặc chạy lệnh: `php artisan tinker` rồi `User::where('email', 'admin@example.com')->first()->update(['password' => Hash::make('newpassword')])`

### Q: Tạo thêm admin user?
A: Sử dụng Tinker hoặc phát triển trang quản lý user trong Filament.

### Q: Cấp quyền cho user khác?
A: Update `is_admin` field của user thành `true` trong database.

### Q: Làm thế nào để thêm trường mới?
A: Chỉnh sửa file Resource tương ứng trong `app/Filament/Admin/Resources/` và thêm trường vào `form()` và `table()` methods.

## 📞 Hỗ trợ

Nếu gặp vấn đề:
1. Kiểm tra logs: `storage/logs/laravel.log`
2. Clear cache: `php artisan optimize:clear`
3. Kiểm tra browser console: F12 > Console
4. Liên hệ developer team
