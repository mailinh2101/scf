# 🔒 Fix: 403 Forbidden Error on Hostinger

## ❌ The Problem

```
403 Forbidden
Access to this resource on the server is denied!
```

This error means the server is **refusing to grant access** to your files. Common causes:

1. ❌ Wrong file permissions (too restrictive)
2. ❌ `.htaccess` rules blocking access
3. ❌ PHP not configured to execute
4. ❌ Directory ownership issues
5. ❌ SELinux/security module blocking

---

## ✅ Solution 1: Fix File Permissions (Most Common)

### Via SSH (Recommended)

```bash
# SSH into Hostinger
ssh username@yourdomain.com

# Navigate to project
cd ~/public_html

# Fix permissions for all files
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Specifically fix storage & bootstrap
chmod -R 775 storage bootstrap/cache
chmod -R 775 public
```

### Via cPanel File Manager

1. Log into **cPanel**
2. Open **File Manager**
3. Navigate to your project root
4. **Right-click → Change Permissions**
5. Set to **755** for directories, **644** for files
6. Check **"Recursive"** and apply

---

## ✅ Solution 2: Fix .htaccess

Your `.htaccess` might have incorrect rules. Check/create proper `.htaccess` in your project root:

### In `public_html/.htaccess`

```apache
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### In `public_html/public/.htaccess`

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## ✅ Solution 3: Check PHP Execution

### Create Test File: `public/test.php`

```php
<?php
echo "✅ PHP is working!<br>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Current User: " . get_current_user() . "<br>";

// Test file permissions
$testFile = '../bootstrap/app.php';
if (is_readable($testFile)) {
    echo "✅ Can read bootstrap/app.php<br>";
} else {
    echo "❌ Cannot read bootstrap/app.php - permission issue!<br>";
}

// Test storage permissions
$storageDir = '../storage';
if (is_writable($storageDir)) {
    echo "✅ Storage directory is writable<br>";
} else {
    echo "❌ Storage directory is NOT writable - fix permissions!<br>";
}
?>
```

Access: `https://yourdomain.com/test.php`

**Expected output:**
```
✅ PHP is working!
PHP Version: 8.x.x
Current User: nobody
✅ Can read bootstrap/app.php
✅ Storage directory is writable
```

⚠️ **DELETE test.php after checking!**

---

## ✅ Solution 4: Check Domain Configuration

### Is your domain pointing to the correct folder?

1. Go to **cPanel → Addon Domains** (or **Domains**)
2. Find your domain (e.g., `scf.vn`)
3. Check it points to: `/public_html` (or `/public_html/public` for Laravel)

**For Laravel, it should point to:**
- `public_html/public` (if Laravel is in `public_html/`)
- OR `public_html` (if you moved everything inside `public_html/public/`)

---

## ✅ Solution 5: Check with cPanel File Manager Permissions

1. **cPanel → File Manager**
2. **Enable "Show Hidden Files"** (Settings gear icon)
3. Look for these files in `public_html`:
   - `.htaccess` - Should exist
   - `index.php` - Should be readable
   - `composer.json` - Should be readable

4. Right-click each → **Change Permissions:**
   - Files: `644` (rw-r--r--)
   - Directories: `755` (rwxr-xr-x)

---

## 🧪 Verification Steps

### Step 1: SSH Into Server

```bash
ssh username@yourdomain.com
cd ~/public_html
```

### Step 2: Check Directory Structure

```bash
# List files with permissions
ls -la

# Should show something like:
# -rw-r--r-- (644) for files
# drwxr-xr-x (755) for directories
```

### Step 3: Fix Permissions

```bash
# Make all files readable
find . -type f -exec chmod 644 {} \;

# Make all directories executable
find . -type d -exec chmod 755 {} \;

# Make storage & cache writable
chmod -R 775 storage bootstrap/cache public

# Verify
ls -la storage/
```

### Step 4: Check .htaccess Exists

```bash
# Check if .htaccess exists in public folder
cat public/.htaccess

# If not found, create it
touch public/.htaccess
nano public/.htaccess
# Paste the .htaccess content from Solution 2 above
```

### Step 5: Test Laravel

```bash
# Test artisan works
php artisan tinker
>>> echo "✅ Laravel working"

# Test database connection
>>> DB::connection()->getPdo()

# Exit with Ctrl+C or type exit
```

---

## 📋 Quick Checklist

- [ ] SSH'd into Hostinger server
- [ ] Ran: `find . -type f -exec chmod 644 {} \;`
- [ ] Ran: `find . -type d -exec chmod 755 {} \;`
- [ ] Ran: `chmod -R 775 storage bootstrap/cache public`
- [ ] Verified `.htaccess` exists in `public/` folder
- [ ] Created `public/test.php` and verified PHP works
- [ ] Accessed `https://yourdomain.com/` (should see Laravel home page)
- [ ] Deleted `public/test.php`
- [ ] Ran `php artisan tinker` successfully
- [ ] Checked database connection: `DB::connection()->getPdo()`

---

## 🚀 If Still Getting 403

### Check cPanel Settings

1. **cPanel → Advanced Zone Editor** (DNS)
   - Verify domain A record points to correct IP

2. **cPanel → Addon Domains**
   - Verify domain is configured correctly
   - Check "Document Root" is set to `public_html` or `public_html/public`

3. **cPanel → MultiPHP Manager**
   - Verify PHP 8.x is selected for your domain
   - NOT PHP 7.4 or lower

### Check Server Logs

```bash
# View Apache/PHP error logs
tail -50 ~/logs/error_log
tail -50 ~/logs/access_log

# Or via cPanel: Error Log viewer
```

### Contact Hostinger Support

Provide them:
1. Domain name: `scf.vn`
2. Error: `403 Forbidden`
3. Laravel project deployed
4. PHP version: `php -v`
5. File permissions: `ls -la ~/public_html/`
6. Error logs from above

---

## 🔧 Complete Fix Script (All-in-One)

If you have SSH access, run this:

```bash
#!/bin/bash

# SSH into Hostinger and run this script

cd ~/public_html

echo "🔧 Fixing Laravel permissions..."

# Fix file permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Make storage & cache writable
chmod -R 775 storage bootstrap/cache

# Make public writable for assets
chmod -R 775 public

# Verify
echo "✅ Permissions fixed!"
echo ""
echo "Directory permissions:"
ls -ld . storage bootstrap/cache public

echo ""
echo "Testing database connection..."
php artisan tinker <<EOF
DB::connection()->getPdo()
exit
EOF

echo "✅ All fixed! Visit https://yourdomain.com"
```

Save as `fix_permissions.sh` and run:
```bash
bash fix_permissions.sh
```

---

## 📝 Common Causes & Fixes

| Error | Cause | Fix |
|-------|-------|-----|
| 403 Forbidden | Wrong permissions | `chmod -R 755 .` |
| 403 Forbidden | `.htaccess` issue | Create proper `.htaccess` |
| 403 Forbidden | PHP disabled | Contact Hostinger, enable PHP |
| 403 Forbidden | Domain wrong root | cPanel → Addon Domains, check root |
| 403 Forbidden | SELinux blocking | Contact Hostinger support |

---

## ✅ Success Indicators

Once fixed, you should see:
- ✅ Website loads on `https://yourdomain.com`
- ✅ All pages accessible (home, about, contact, etc.)
- ✅ Contact form works
- ✅ Admin panel works: `/admin`
- ✅ No 403 errors
- ✅ Laravel logs show no permission errors

---

**Last Updated:** November 2025
