# Hướng Dẫn Deploy Laravel lên Hostinger

**Tình trạng:** Phiên bản cuối cùng cho SCF Laravel Application  
**Cập nhật:** November 2025  
**Vấn đề chính:** Hostinger sử dụng Composer v1, nhưng dự án cần Composer v2+

---

## 📋 Yêu Cầu Trước Deploy

### Chuẩn Bị Trên Máy Tính Cá Nhân
- [ ] Git repo được push lên GitHub (hoặc repository khác)
- [ ] `.env.example` đã cập nhật với tất cả required keys
- [ ] Local environment chạy mà không có lỗi: `php artisan serve`
- [ ] Build frontend assets: `npm run build`
- [ ] Tất cả migrations đã tạo và test thành công
- [ ] Database seeders hoạt động: `php artisan db:seed`

### Kiểm Tra Hostinger
- [ ] Bạn có SSH access (không phải shared hosting cơ bản)
- [ ] Hostinger cPanel có thể truy cập được
- [ ] PHP version >= 8.0: `php -v`
- [ ] MySQL/MariaDB hoạt động: `mysql --version`
- [ ] Disk space đủ (tối thiểu 500MB miễn phí)

---

## 🚀 Workflow A: Deploy với SSH (Khuyến Nghị)

### Bước 1: Kết Nối SSH

```bash
# PowerShell / Command Prompt (Windows)
ssh username@hostname.com

# Hoặc sử dụng PuTTY nếu không có SSH client
```

**Hostinger SSH Details:**
- Host: `yourdomain.com` hoặc `123.45.67.89`
- User: Tìm trong cPanel → SSH Access
- Port: Thường là 22 (có thể khác)

### Bước 2: Clone Repo & Điều Hướng

```bash
cd ~/public_html/  # hoặc thư mục deploy của bạn

# Clone repository
git clone https://github.com/yourusername/starvik.git .

# Hoặc nếu đã có repo, pull latest code
git pull origin main
```

### Bước 3: Cài Đặt Composer v2 (Workaround Hostinger)

```bash
# 1. Tải Composer v2 installer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# 2. Cài đặt Composer v2 vào home directory
php composer-setup.php --2 --install-dir=$HOME

# 3. Xóa installer script
rm composer-setup.php

# 4. Kiểm tra cài đặt
php ~/composer.phar --version
# Output: Composer version 2.x.x
```

### Bước 4: Cài Đặt Dependencies

```bash
# Cài PHP dependencies (không cần dev packages)
php ~/composer.phar install --no-dev --optimize-autoloader

# Nếu Composer không nhận ra, thử:
php -d memory_limit=-1 ~/composer.phar install --no-dev --optimize-autoloader
```

### Bước 5: Cấu Hình Environment

```bash
# 1. Copy .env.example -> .env
cp .env.example .env

# 2. Tạo APP_KEY
php artisan key:generate

# 3. Cập nhật .env với database credentials của Hostinger
nano .env
# Hoặc dùng editor khác: vim, vi, ...

# Các biến cần cập nhật:
# APP_ENV=production
# APP_DEBUG=false
# APP_URL=https://yourdomain.com
# DB_HOST=localhost (hoặc IP từ Hostinger)
# DB_DATABASE=your_db_name
# DB_USERNAME=your_db_user
# DB_PASSWORD=your_db_password
# MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD (nếu cần)
```

### Bước 6: Chạy Migrations

```bash
# 1. Tạo database tables
php artisan migrate

# 2. (Optional) Seed sample data
php artisan db:seed
```

### Bước 7: Cấp Quyền & Storage Link

```bash
# 1. Cấp quyền cho storage & bootstrap/cache
chmod -R 775 storage bootstrap/cache

# 2. Tạo symlink cho public/storage
php artisan storage:link

# Hoặc nếu symlink không hoạt động (Hostinger không support):
# Thêm vào .htaccess hoặc config/filesystems.php để dùng direct path

# 3. Xác nhận quyền owner
chown -R nobody:nobody storage bootstrap/cache

# Hoặc nếu cPanel, sử dụng file manager
```

### Bước 8: Tối Ưu Hóa & Cache

```bash
# Tạo config cache
php artisan config:cache

# Tạo route cache
php artisan route:cache

# Tạo view cache
php artisan view:cache

# Xóa cache (nếu cần debug)
php artisan cache:clear
php artisan view:clear
```

### Bước 9: Cấu Hình Web Server

**Nếu Hostinger / cPanel tự động:**
- Domain public_html đã trỏ tới `/public`? ✓ Xong

**Nếu cần manual:**

```bash
# Kiểm tra .htaccess trong public_html
cat .htaccess

# Nếu không có, tạo:
touch .htaccess

# Nội dung .htaccess cơ bản:
# <IfModule mod_rewrite.c>
#     RewriteEngine on
#     RewriteCond %{REQUEST_URI} !^public
#     RewriteRule ^(.*)$ public/$1 [L]
# </IfModule>
```

### Bước 10: Kiểm Tra Deploy

```bash
# 1. Từ machine khác, test website
curl https://yourdomain.com

# 2. Hoặc mở browser: https://yourdomain.com

# 3. Check logs nếu có lỗi
tail -f storage/logs/laravel.log

# 4. Test specific page (e.g., contact form)
curl https://yourdomain.com/contact
```

---

## 🔄 Workflow B: Deploy Không SSH (Upload via cPanel)

### Bước 1: Build Assets & Dependencies Cục Bộ

**Trên máy tính của bạn:**

```bash
# 1. Cài đặt dependencies
composer install --no-dev --optimize-autoloader

# 2. Build frontend assets
npm run build

# 3. Xóa các folder không cần
rm -rf node_modules tests bootstrap/cache/* .git .env.local

# 4. Copy .env.example -> .env (để upload)
cp .env.example .env
```

### Bước 2: Nén & Upload

```bash
# 1. Nén tất cả (trừ những folder lớn)
# ZIP: public/, app/, config/, database/, routes/, resources/
#      bootstrap/, vendor/, storage/
#      .env, artisan, composer.json, package.json, vite.config.js

# Hoặc dùng cmd:
Compress-Archive -Path app, bootstrap, config, database, public, `
  resources, routes, storage, vendor, artisan, .env, composer.json, `
  package.json, vite.config.js -DestinationPath starvik_deploy.zip
```

### Bước 3: Upload via cPanel File Manager

1. Đăng nhập cPanel
2. File Manager → public_html
3. Upload file `starvik_deploy.zip`
4. Extract Here
5. Xóa file `starvik_deploy.zip`

### Bước 4: Cấu Hình & Khởi Động

**Via cPanel SSH (nếu có):**

```bash
cd ~/public_html

# 1. Cập nhật .env
nano .env
# (Điền DB credentials, APP_URL, etc.)

# 2. Generate APP_KEY
php artisan key:generate

# 3. Run migrations
php artisan migrate

# 4. Cập nhật quyền
chmod -R 775 storage bootstrap/cache
php artisan storage:link
```

**Nếu không có SSH:**
- Dùng cPanel File Manager để edit `.env`
- Contact Hostinger support để chạy migrations
- Hoặc tạo file `public/migrate.php`:

```php
<?php
// public/migrate.php (DELETE AFTER RUNNING!)
if ($_GET['token'] !== env('APP_KEY')) exit('Forbidden');

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->call('migrate');
$kernel->terminate(new Symfony\Component\Console\Input\StringInput(''), 
                   new Symfony\Component\Console\Output\BufferedOutput());

echo 'Migrations completed';
?>
```

Truy cập: `https://yourdomain.com/migrate.php?token=YOUR_APP_KEY`

---

## ✅ Post-Deployment Checklist

### Kiểm Tra Cơ Bản
- [ ] Website hiển thị (không có error 500)
- [ ] Contact form gửi được (test email)
- [ ] Trang blog hiển thị sản phẩm
- [ ] Admin panel truy cập được `/admin`
- [ ] Static assets load (CSS, JS, images)

### Database & Data
- [ ] Migrations chạy thành công (check `php artisan tinker` → `\App\Models\User::count()`)
- [ ] Seeders chạy (sample products hiện tại?)
- [ ] SiteSetting entries tồn tại

### Performance & Security
- [ ] `.env` set `APP_DEBUG=false`
- [ ] `.env` set `APP_ENV=production`
- [ ] Cache config/route/view đã build
- [ ] Static files (JS, CSS) được cache (check headers)
- [ ] SSL certificate working (green lock)

### File Permissions
- [ ] `storage/` world-writable (775)
- [ ] `bootstrap/cache/` world-writable (775)
- [ ] `public/storage` symlink hoạt động

### Error Logs
```bash
# Check recent errors
tail -30 storage/logs/laravel.log

# Monitor in real-time
tail -f storage/logs/laravel.log
```

---

## 🔧 Sử Dụng Deploy Script

**Nếu bạn có SSH access, dùng script tự động:**

```bash
# 1. Upload file deploy.sh lên server
scp deploy.sh username@hostname.com:~/public_html/

# 2. SSH vào server
ssh username@hostname.com

# 3. Chạy script
cd ~/public_html
chmod +x deploy.sh
./deploy.sh production

# Script sẽ tự động:
# - Tải composer v2
# - Pull code từ git
# - Cài dependencies
# - Chạy migrations
# - Cấp quyền
# - Build cache
# - Tạo backup
```

**Các option:**
```bash
./deploy.sh production          # Full deployment
./deploy.sh staging            # Deploy lên staging environment
```

---

## 🚨 Troubleshooting

### 1. Lỗi: "Composer not found" hoặc "composer command not found"

**Giải pháp:**
```bash
# Kiểm tra composer đã cài không
php ~/composer.phar --version

# Nếu không có, cài lại
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --2 --install-dir=$HOME
rm composer-setup.php
```

### 2. Lỗi: "PHP Fatal error: Allowed memory exhausted"

**Giải pháp:**
```bash
# Tăng memory limit khi chạy composer
php -d memory_limit=-1 ~/composer.phar install --no-dev --optimize-autoloader

# Hoặc permanent, edit php.ini
php -i | grep "php.ini"  # Tìm file php.ini
nano /path/to/php.ini     # memory_limit = 512M
```

### 3. Lỗi: "Symlink not supported on this filesystem"

**Giải pháp:**
```bash
# Tắt symlink, dùng copy thay vì
# Trong config/filesystems.php:
'links' => [
    public_path('storage') => storage_path('app/public'),
    // Comment out nếu không cần
],

# Hoặc dùng direct path trong Blade:
{{ asset('storage/' . $image) }}  # Thay vì storage_path()
```

### 4. Lỗi: "SQLSTATE[HY000]: General error: 2006 MySQL server has gone away"

**Giải pháp:**
```bash
# Check database connection
php artisan tinker
>>> DB::connection()->getPdo();  # Nếu OK, connection hoạt động

# Nếu lỗi, cập nhật .env:
DB_HOST=localhost
DB_PORT=3306
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci
```

### 5. Lỗi: "File not found: 404 on all pages except root"

**Giải pháp:**
```bash
# Enable mod_rewrite trong Apache
# 1. Kiểm tra .htaccess trong public folder
cat public/.htaccess

# 2. Nếu không có, thêm:
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [QSA,L]
</IfModule>

# 3. Hoặc contact Hostinger support để enable mod_rewrite
```

### 6. Lỗi: "Access denied for user 'db_user'@'127.0.0.1'"

**Giải pháp:**
```bash
# 1. Kiểm tra DB credentials trong cPanel MySQL
cPanel → MySQL Databases → Xem username/password

# 2. Update .env
DB_HOST=localhost
DB_DATABASE=correctname
DB_USERNAME=correctuser
DB_PASSWORD=correctpass

# 3. Test kết nối
php artisan tinker
>>> DB::connection()->getPdo();
```

### 7. Lỗi: "Session driver 'file' not writable"

**Giải pháp:**
```bash
# Cấp quyền session folder
chmod -R 777 storage/framework/sessions

# Hoặc dùng database sessions thay vì file
# .env: SESSION_DRIVER=database
# Tạo sessions table: php artisan session:table
# Migration: php artisan migrate
```

---

## 📊 Performance Optimization

### 1. Enable Caching

```bash
# Config caching
php artisan config:cache

# Route caching
php artisan route:cache

# View caching
php artisan view:cache

# Clear khi cần update
php artisan cache:clear
php artisan view:clear
```

### 2. Optimize Autoloader

```bash
# Đã chạy khi install
composer install --no-dev --optimize-autoloader

# Hoặc dump lại
composer dump-autoload -o
```

### 3. Enable Gzip Compression

Trong `.htaccess`:
```apache
# Enable GZIP compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE text/javascript
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>
```

### 4. Browser Caching

Trong `.htaccess`:
```apache
# Browser caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpeg "access plus 1 month"
    ExpiresByType image/gif "access plus 1 month"
    ExpiresByType image/png "access plus 1 month"
    ExpiresByType text/css "access plus 1 week"
    ExpiresByType application/javascript "access plus 1 week"
</IfModule>
```

---

## 🔄 Update & Rollback

### Deploy Update Baru

```bash
# 1. SSH vào server
ssh username@hostname.com

# 2. Navigate to project
cd ~/public_html

# 3. Backup current state
cp -r . ~/backups/before_update_$(date +%s)

# 4. Pull latest code
git pull origin main

# 5. Update dependencies
php ~/composer.phar install --no-dev --optimize-autoloader

# 6. Run any new migrations
php artisan migrate --force

# 7. Clear cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Kiểm tra website
curl https://yourdomain.com
```

### Rollback to Previous Version

```bash
# 1. Restore từ backup
cp -r ~/backups/before_update_TIMESTAMP/* ~/public_html/

# 2. Rollback database
php artisan migrate:rollback

# 3. Clear cache
php artisan cache:clear
```

---

## 📞 Hỗ Trợ & Liên Hệ

- **Hostinger Support**: [support.hostinger.com](https://support.hostinger.com)
- **Laravel Docs**: [laravel.com/docs](https://laravel.com/docs)
- **Filament Docs**: [filamentphp.com](https://filamentphp.com)

### Thông Tin cần chuẩn bị khi liên hệ support:
1. Error message chính xác (từ `storage/logs/laravel.log`)
2. PHP version: `php -v`
3. MySQL version: `mysql --version`
4. Composer version: `php ~/composer.phar --version`
5. Các bước đã thử để fix

---

## 📝 Chú ý quan trọng

1. **Composer v1 vs v2**: Hostinger cài v1 mặc định, nhưng dự án cần v2 → sử dụng local `composer.phar`
2. **SSH access**: Nếu không có SSH, phải build + upload locally (chậm, phức tạp)
3. **Backup**: Luôn backup trước khi migrate hoặc update
4. **APP_DEBUG**: LUÔN để `false` trên production
5. **Permissions**: Storage + bootstrap cache cần 775
6. **.env security**: KHÔNG push `.env` lên Git

---

## 📋 Quick Reference Commands

```bash
# SSH Connect
ssh username@hostname.com

# Check versions
php -v
mysql --version
php ~/composer.phar --version

# Install/Update
cd ~/public_html
git pull origin main
php ~/composer.phar install --no-dev --optimize-autoloader
php artisan migrate --force

# Cache & Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Logs & Debug
tail -f storage/logs/laravel.log
php artisan tinker

# Permissions
chmod -R 775 storage bootstrap/cache
php artisan storage:link

# Cleanup
php artisan cache:clear
php artisan view:clear
rm -rf bootstrap/cache/*
```

---

**Last Updated:** November 2025  
**Maintained by:** SCF Development Team  
**Version:** 1.0
