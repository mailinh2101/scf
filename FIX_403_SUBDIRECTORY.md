# ✅ Fix 403 Forbidden - Subdirectory Setup (public_html/scf/)

## 🎯 Your Setup

```
public_html/
└── scf/  ← Your Laravel app is HERE
    ├── public/
    │   ├── index.php  ← Web entry point
    │   ├── .htaccess
    │   └── ...
    ├── storage/
    ├── app/
    ├── config/
    └── .env
```

This is a **subdirectory installation** - your Laravel `public/` folder needs to be the web root.

---

## ✅ Solution: Configure Domain to Point to `scf/public/`

### Option A: Via cPanel (Recommended)

1. **Log into cPanel**
2. Go to **Addon Domains** (or **Domains**)
3. Find your domain `scf.vn`
4. **Edit** or **Modify** the domain
5. Change **Document Root** from:
   ```
   public_html
   ```
   To:
   ```
   public_html/scf/public
   ```
6. **Save** and wait 5-15 minutes for changes to apply

### Option B: Via .htaccess (If cPanel doesn't allow changes)

Create `.htaccess` in `public_html/` to redirect to the `scf/public/` folder:

**File: `public_html/.htaccess`**

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Redirect to scf/public directory
    RewriteCond %{REQUEST_URI} !^/scf/public/ [NC]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ /scf/public/$1 [L]
</IfModule>
```

### Option C: Move Files (If other options don't work)

Move your Laravel app directly to `public_html/`:

```bash
# SSH into Hostinger
ssh username@yourdomain.com

cd ~/public_html

# Backup current setup
mv scf scf_backup

# Move Laravel files up
mv scf_backup/* .

# Clean up
rmdir scf_backup

# Verify structure
ls -la
# Should show: app/, config/, public/, storage/, etc. directly in public_html/
```

---

## ✅ Fix File Permissions

After configuring the domain, fix permissions:

```bash
ssh username@yourdomain.com
cd ~/public_html/scf

# Fix all permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Make storage & bootstrap/cache writable
chmod -R 775 storage bootstrap/cache

# Make public writable
chmod -R 775 public

# Verify storage link
php artisan storage:link

echo "✅ Permissions fixed!"
```

---

## ✅ Update .env (if not done)

Your `.env` should have:

```properties
APP_ENV=production
APP_DEBUG=false
APP_URL=https://scf.vn

DB_HOST=auth-db603.hstgr.io
DB_DATABASE=u528358323_rN99l
DB_USERNAME=u528358323_de74V
DB_PASSWORD="Lamtruong123@#"

CACHE_DRIVER=file
SESSION_DRIVER=file
FILESYSTEM_DISK=public
```

---

## 🧪 Test Connection

```bash
ssh username@yourdomain.com
cd ~/public_html/scf

# Test database
php artisan tinker
>>> DB::connection()->getPdo()
>>> exit

# Run migrations
php artisan migrate --force

# Clear cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ All done!"
```

---

## 📋 Verification Checklist

- [ ] cPanel → Addon Domains
- [ ] Domain `scf.vn` Document Root set to `public_html/scf/public`
- [ ] Waited 5-15 minutes for DNS cache to clear
- [ ] SSH'd into Hostinger
- [ ] Changed to `~/public_html/scf` directory
- [ ] Fixed file permissions (644/755)
- [ ] Made storage & cache directories 775
- [ ] Ran `php artisan migrate --force`
- [ ] Accessed `https://scf.vn/` in browser
- [ ] No 403 errors
- [ ] Database connection working

---

## 🚀 What to Expect After Fix

```
https://scf.vn/                  → Home page ✅
https://scf.vn/contact           → Contact page ✅
https://scf.vn/blog              → Blog page ✅
https://scf.vn/admin             → Admin panel ✅
https://scf.vn/admin/login       → Filament login ✅
```

---

## 🆘 If Still Getting 403

### 1. Verify .htaccess in `scf/public/`

```bash
ssh username@yourdomain.com
cd ~/public_html/scf/public
cat .htaccess

# Should show Laravel routing rules
# If empty or missing, create:
```

**File: `~/public_html/scf/public/.htaccess`**

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

### 2. Verify PHP is Enabled

Create test file `~/public_html/scf/public/test.php`:

```php
<?php
echo "✅ PHP Working!";
echo "Version: " . phpversion();
?>
```

Access: `https://scf.vn/test.php`

If it shows, PHP is working. If 403, contact Hostinger support.

### 3. Check Apache Error Logs

```bash
ssh username@yourdomain.com
tail -50 ~/logs/error_log
# Look for permission or rewrite errors
```

---

## 📞 Contact Hostinger Support If Needed

Provide them:
1. **Domain:** `scf.vn`
2. **Issue:** Getting 403 Forbidden on Laravel application
3. **Setup:** Laravel app in `public_html/scf/`, need Document Root set to `public_html/scf/public/`
4. **PHP:** 8.x enabled
5. **Request:** Help configure domain to use `scf/public/` as document root

---

## 📝 Summary

Your 403 error is because:
- ❌ Domain is pointing to `public_html/`
- ❌ But Laravel entry point is in `public_html/scf/public/index.php`
- ✅ **Fix:** Point domain to `public_html/scf/public/`

Once that's done, your site will work! 🚀
