# Hướng Dẫn Xử Lý Form Nộp Đơn Ứng Tuyển

## Tổng Quan

Hệ thống xử lý form nộp đơn ứng tuyển cho phép các ứng viên nộp đơn ứng tuyển trực tuyến với CV dưới dạng file PDF.

## Các Thành Phần

### 1. **JobApplicationController** (`app/Http/Controllers/JobApplicationController.php`)
- Xử lý việc gửi form nộp đơn ứng tuyển
- Validate dữ liệu form
- Lưu file CV vào storage
- Gửi email xác nhận cho ứng viên
- Gửi email thông báo cho admin

### 2. **JobApplication Model** (`app/Models/JobApplication.php`)
- Định nghĩa cấu trúc dữ liệu của đơn ứng tuyển
- Các scope methods cho truy vấn
- Status labels cho theo dõi tình trạng

### 3. **Database Migration** (`database/migrations/2024_11_07_create_job_applications_table.php`)
- Tạo bảng `job_applications` lưu trữ đơn ứng tuyển
- Các field chính:
  - `name`: Tên ứng viên
  - `email`: Email ứng viên
  - `phone`: Số điện thoại
  - `position`: Vị trí ứng tuyển
  - `message`: Thư xin việc
  - `cv_path`: Đường dẫn file CV
  - `status`: Trạng thái đơn (`new`, `reviewing`, `shortlisted`, `interviewed`, `rejected`, `accepted`)

### 4. **Email Templates**
- `resources/views/emails/application-confirmation.blade.php`: Email xác nhận cho ứng viên
- `resources/views/emails/application-notification.blade.php`: Email thông báo cho admin

### 5. **Routes** (`routes/web.php`)
```php
Route::post('/job-application/submit', [JobApplicationController::class, 'submit'])->name('job.application.submit');
```

## Cách Sử Dụng

### Bước 1: Chạy Migration
```bash
php artisan migrate
```

### Bước 2: Cấu Hình Email Admin
Thêm vào file `.env`:
```
ADMIN_EMAIL=admin@starvik.com
```

Hoặc cấu hình trong `config/app.php`:
```php
'admin_email' => env('ADMIN_EMAIL', 'admin@starvik.com'),
```

### Bước 3: Cấu Hình Mail Driver
Cấu hình SMTP trong `.env`:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@starvik.com
MAIL_FROM_NAME="Starvik"
```

Hoặc sử dụng log driver để test:
```
MAIL_DRIVER=log
```

### Bước 4: Form HTML
Form đã được tích hợp trong `resources/views/job-detail.blade.php`:

```blade
<form method="post" action="{{ route('job.application.submit') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="position" value="{{ $job->title }}">
    
    <input type="text" name="name" required>
    <input type="email" name="email" required>
    <input type="text" name="phone">
    <textarea name="message" maxlength="5000"></textarea>
    <input type="file" name="cv" accept="application/pdf" required>
    
    <button type="submit">Gửi Hồ Sơ</button>
</form>
```

## Validation

Form được validate với các quy tắc:
- `name`: Bắt buộc, chuỗi, tối đa 255 ký tự
- `email`: Bắt buộc, email hợp lệ, tối đa 255 ký tự
- `phone`: Tuỳ chọn, chuỗi, tối đa 20 ký tự
- `position`: Bắt buộc, chuỗi, tối đa 255 ký tự
- `message`: Tuỳ chọn, chuỗi, tối đa 5000 ký tự
- `cv`: Bắt buộc, file PDF, tối đa 5MB

## Xử Lý File

- File CV được lưu trong thư mục: `storage/app/public/job-applications/`
- Tên file được tự động generate: `{timestamp}_{original_filename}.pdf`
- Có thể truy cập file qua URL: `/storage/job-applications/{filename}`

## Email Notifications

### Email Xác Nhận (Ứng Viên)
- **Chủ đề**: "Đơn ứng tuyển của bạn đã được nhận - Starvik"
- **Nội dung**: Xác nhận nhận đơn + Thông tin cơ bản
- **Gửi đến**: Email của ứng viên

### Email Thông Báo (Admin)
- **Chủ đề**: "Đơn ứng tuyển mới từ [Tên ứng viên]"
- **Nội dung**: Chi tiết đơn ứng tuyển + Thông tin liên hệ
- **Gửi đến**: Email được cấu hình trong `ADMIN_EMAIL`

## Quản Lý Đơn Ứng Tuyển

### Truy vấn dữ liệu
```php
// Lấy tất cả đơn mới
$newApplications = JobApplication::new()->get();

// Lấy đơn cho một vị trí cụ thể
$positionApplications = JobApplication::forPosition('Manager')->get();

// Lấy đơn từ một ngày
$recentApplications = JobApplication::fromDate(now()->subDays(7))->get();
```

### Cập nhật trạng thái
```php
$application = JobApplication::find(1);
$application->update(['status' => 'reviewing']);
```

### Status có sẵn
- `new`: Mới (mặc định)
- `reviewing`: Đang xem xét
- `shortlisted`: Đã rút gọn
- `interviewed`: Đã phỏng vấn
- `rejected`: Từ chối
- `accepted`: Chấp nhận

## Lỗi Xử Lý

Nếu có lỗi trong quá trình xử lý:
1. **Validation Error**: Trả về form với lỗi validation
2. **File Upload Error**: Tự động xử lý, đơn vẫn được lưu nếu không có file
3. **Email Error**: Log lỗi nhưng không làm hỏng quá trình gửi đơn
4. **Database Error**: Exception được catch và người dùng được thông báo

## Troubleshooting

### Email không được gửi
1. Kiểm tra cấu hình SMTP trong `.env`
2. Xem log file: `storage/logs/laravel.log`
3. Test mail configuration: `php artisan tinker` -> `Mail::raw('test', function($message) { $message->to('test@test.com'); });`

### File CV không được lưu
1. Kiểm tra quyền thư mục: `storage/app/public/`
2. Chạy: `php artisan storage:link`
3. Kiểm tra kích thước file (tối đa 5MB)
4. Kiểm tra file type (chỉ PDF được chấp nhận)

### Không thấy dữ liệu đơn ứng tuyển
1. Chắc chắn migration đã chạy: `php artisan migrate`
2. Kiểm tra bảng `job_applications` có tồn tại trong database
3. Xem log file để tìm lỗi

## Bảo Mật

- Form sử dụng CSRF protection (`@csrf`)
- File CV được validate (chỉ PDF, tối đa 5MB)
- Email được validate
- Input được escape trong email template
- IP address và User Agent được lưu cho tracking

## Tùy Chỉnh

### Thay đổi kích thước file tối đa
Trong `JobApplicationController.php`:
```php
'cv' => 'required|file|mimes:pdf|max:10240', // 10MB
```

### Thay đổi đường dẫn lưu file
Trong `JobApplicationController.php`:
```php
$cvPath = $request->file('cv')->store('custom-path', 'public');
```

### Thêm validation field khác
Trong `JobApplicationController.php`, thêm vào validation array:
```php
'custom_field' => 'required|string|max:255',
```

## Liên Hệ

Nếu có bất kỳ vấn đề nào, liên hệ admin tại email được cấu hình hoặc kiểm tra log file.
