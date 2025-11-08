# 🔧 Fix: SQLSTATE[HY000] [1045] Database Connection Error

## ❌ The Problem

```
SQLSTATE[HY000] [1045] Access denied for user 'u528358323_de74V'@'2a02:4780:3:15::2' 
(using password: YES)
```

This error means:
- **User:** `u528358323_de74V` (Hostinger database user)
- **Host:** `2a02:4780:3:15::2` (IPv6 address of Hostinger database server)
- **Status:** Connection rejected (wrong password or user doesn't have permission)

**Root Cause:** Your `.env` file has LOCAL credentials (root/localhost) but your application is trying to connect to Hostinger's database with those wrong credentials.

---

## ✅ Solution: Update .env with Correct Credentials

### Step 1: Get Correct Credentials from Hostinger

#### Via cPanel:
1. Log in to Hostinger cPanel
2. Click **MySQL Databases** (or **MySQL®/MariaDB™**)
3. Look for section: **Current Users** or **MySQL Databases**
4. Find your database entry with structure:
   - `u528358323_databasename` (prefix: account number like `u528358323`)
   - Username: `u528358323_username` (or similar)
   - Password: Your database password

**Screenshot locations:**
- Database name: Listed under "Database Name" column
- Username: Listed under "Username" column
- Password: Click "Change Password" to view/reset
- Host: Usually `localhost` for Hostinger

---

### Step 2: Update .env File

**Edit `.env` file:**

```bash
# For Windows (PowerShell)
notepad .env

# For Mac/Linux (via SSH)
nano .env
```

**Update these values:**

```properties
# BEFORE (Local Development):
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# AFTER (Hostinger Production):
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u528358323_your_database_name
DB_USERNAME=u528358323_your_username
DB_PASSWORD=your_actual_password
```

**Replace with YOUR actual values from cPanel:**
- `u528358323_your_database_name` → Your actual database name (e.g., `u528358323_starvik`)
- `u528358323_your_username` → Your actual username (e.g., `u528358323_scfuser`)
- `your_actual_password` → Your database password

### Step 3: Also Update Production Settings

```properties
# Production Environment Settings
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Cache Drivers (use file for shared hosting)
CACHE_DRIVER=file
SESSION_DRIVER=file

# Mail Configuration (update if needed)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
MAIL_USERNAME=your-email@yourdomain.com
MAIL_PASSWORD=your-email-password
```

---

## 🧪 Step 4: Verify Connection

### Option A: Using Laravel Tinker (SSH)

```bash
# SSH into your Hostinger account
ssh username@yourdomain.com

# Navigate to project
cd ~/public_html

# Open Tinker console
php artisan tinker

# Test database connection
>>> DB::connection()->getPdo()

# If successful: Illuminate\Database\MySqlConnection Object
# If failed: Error message will show connection details
```

### Option B: Using MySQL Client (SSH)

```bash
# SSH into Hostinger
ssh username@yourdomain.com

# Test database connection directly
mysql -h localhost -u u528358323_username -p u528358323_database_name

# When prompted, enter your database password
# If connected, you'll see: mysql>
# Type: SELECT DATABASE(); exit
```

### Option C: Check via PHP (Create test file)

Create `public/db_test.php`:

```php
<?php
// ⚠️ DELETE THIS FILE AFTER TESTING!

$host = 'localhost';
$user = 'u528358323_your_username';
$pass = 'your_password';
$database = 'u528358323_your_database_name';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "✅ Database connection successful!<br>";
    echo "Connected to: $database<br>";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
?>
```

Access: `https://yourdomain.com/db_test.php`

⚠️ **DELETE this file after testing!**

---

## 🛠️ Troubleshooting

### Error 1: "Access denied for user"
**Cause:** Wrong username or password

**Fix:**
```bash
# SSH to Hostinger
# Go to cPanel > MySQL Databases
# Verify username and password match
# If unsure, click "Change Password" to reset it
# Use new password in .env
```

### Error 2: "Unknown database 'u528358323_wrongname'"
**Cause:** Database name is incorrect

**Fix:**
```bash
# SSH into Hostinger
ssh user@yourdomain.com

# List all databases
mysql -u u528358323_username -p -e "SHOW DATABASES;"

# Copy exact database name and update .env
```

### Error 3: "Can't create a new thread"
**Cause:** Database connection limit or MySQL down

**Fix:**
```bash
# Wait a minute and try again
# SSH and test:
php artisan migrate

# If persists, contact Hostinger support
```

### Error 4: "SQLSTATE[HY000]: General error: 2006 MySQL server has gone away"
**Cause:** Timeout or server connection issue

**Fix:**
```properties
# Add to .env
DB_TIMEZONE=UTC
DB_POOL=5

# Or add to config/database.php (mysql section):
'options' => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_TIMEOUT => 10,
],
```

---

## 📋 Quick Checklist

- [ ] Logged into Hostinger cPanel
- [ ] Found MySQL Databases section
- [ ] Copied database name (e.g., `u528358323_starvik`)
- [ ] Copied username (e.g., `u528358323_scfuser`)
- [ ] Copied password securely
- [ ] Updated `.env` file with correct values
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_ENV=production`
- [ ] Tested connection with `php artisan tinker`
- [ ] Ran migrations: `php artisan migrate --force`
- [ ] Verified application works: `curl https://yourdomain.com`

---

## 🚀 Next Steps After Connection Fixed

```bash
# 1. Run migrations (create tables)
php artisan migrate --force

# 2. Seed initial data
php artisan db:seed --force

# 3. Clear cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Set permissions
chmod -R 775 storage bootstrap/cache

# 5. Verify application
curl https://yourdomain.com
```

---

## 📞 If Issues Persist

**Get this info before contacting support:**
```bash
php -v
mysql --version
php artisan --version

# Test connection:
php artisan tinker
>>> DB::connection()->getDatabaseName()
>>> DB::select('SELECT 1')
```

Then contact:
- **Hostinger Support:** https://support.hostinger.com
- **Include:** Error message, `.env` DB settings (hide password), PHP version, MySQL version
