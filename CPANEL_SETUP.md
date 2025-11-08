# 🚀 Hostinger cPanel Configuration for SCF Laravel

## ⚠️ CRITICAL: Domain Document Root Setting

Your **403 Forbidden error is 99% caused by incorrect domain configuration in cPanel**.

---

## ✅ Fix via cPanel (5 Minutes)

### Step 1: Log into Hostinger cPanel

1. Go to **https://hpanel.hostinger.com**
2. Enter your email & password
3. Click **Manage** next to your domain `scf.vn`
4. Look for **Website** or **Hosting**
5. Click **Manage** or **Settings**

### Step 2: Find Domain Configuration

Look for one of these sections:
- **Addon Domains**
- **Domains**
- **Domain Manager**
- **Website Settings**

### Step 3: Current vs Required Configuration

**WRONG ❌** (What's causing 403):
```
Domain: scf.vn
Document Root: public_html
↓
Tries to serve: public_html/index.html or public_html/index.php
But your Laravel app is in: public_html/scf/public/
Result: 403 Forbidden
```

**CORRECT ✅** (What you need):
```
Domain: scf.vn
Document Root: public_html/scf/public
↓
Serves: public_html/scf/public/index.php (Laravel entry point)
Result: Website works! ✅
```

### Step 4: Update Document Root

In cPanel, find the domain configuration and:

**Before:**
```
Document Root: public_html
```

**After:**
```
Document Root: public_html/scf/public
```

Or select the folder from the dropdown and navigate to `scf/public/`

### Step 5: Save & Wait

1. Click **Save** or **Update**
2. **Wait 5-15 minutes** for DNS/server to update
3. Test: Open `https://scf.vn` in browser
4. Should see your SCF home page (not 403!)

---

## 🔄 Alternative: If You Can't Find Domain Settings

### In Hostinger hPanel Dashboard:

1. Select domain `scf.vn`
2. Left sidebar → **Website**
3. Look for **Document Root** or **Website Root**
4. Click **Change** or **Edit**
5. Select: `scf/public`
6. **Save**

### If That's Not Available:

1. Go to **File Manager**
2. Right-click `scf` folder
3. Look for **Make Primary** or **Set as Document Root**
4. Select it
5. Then select `public` subfolder
6. Click **Make Public** or **Set as Root**

---

## 🛠️ Fix via SSH (If cPanel Doesn't Work)

If changing cPanel doesn't work, use SSH:

```bash
ssh username@yourdomain.com

# Option A: Move entire app up one level
cd ~/public_html
mv scf/* .
rm -rf scf

# Option B: Create .htaccess redirect
cd ~/public_html
cat > .htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/scf/public/ [NC]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ /scf/public/$1 [L]
</IfModule>
EOF

echo "✅ Redirect created"
```

---

## 🔐 Then Run Fix Script

After fixing the domain, SSH and run:

```bash
ssh username@yourdomain.com
cd ~/public_html/scf

# Download fix script (if you don't have it)
# Or paste contents of fix_403.sh

bash fix_403.sh
```

This will:
- ✅ Fix file permissions (644/755)
- ✅ Verify .htaccess
- ✅ Clear Laravel cache
- ✅ Create test files
- ✅ Generate report

---

## 🧪 Verification

After all changes, test:

### 1. Website Loading
```
Browser: https://scf.vn/
Expected: Home page with SCF branding
NOT: 403 Forbidden ❌
```

### 2. Test PHP Execution
```
Browser: https://scf.vn/test_php.php
Expected: Shows PHP info
NOT: 403 Forbidden ❌
```

### 3. Check API Response
```bash
curl -I https://scf.vn/
# Should show: HTTP/1.1 200 OK
# NOT: HTTP/1.1 403 Forbidden
```

---

## 📋 Troubleshooting Checklist

### If Still Getting 403:

- [ ] **Verify cPanel Change Saved**
  ```bash
  # SSH to check actual document root
  pwd
  # Should output: /home/username/public_html/scf/public
  
  # Or check:
  ls -la index.php
  # Should show Laravel's index.php
  ```

- [ ] **Check Web Server Configuration**
  ```bash
  # SSH command
  cat ~/.htaccess 2>/dev/null || echo "No .htaccess in home"
  cat public/.htaccess | grep -i rewrite
  # Should show rewrite rules
  ```

- [ ] **Verify Apache mod_rewrite Enabled**
  ```bash
  php -m | grep rewrite
  # Should output: "Loaded extensions" section with mod_rewrite
  ```

- [ ] **Check File Permissions**
  ```bash
  ssh username@yourdomain.com
  cd ~/public_html/scf
  ls -la public/index.php
  # Should show: -rw-r--r-- (644)
  
  ls -ld public
  # Should show: drwxr-xr-x (755)
  ```

- [ ] **View Server Error Logs**
  ```bash
  ssh username@yourdomain.com
  tail -50 ~/logs/error_log
  # Look for permission or rewrite errors
  ```

---

## 🆘 Emergency: Move App to Root

If cPanel configuration isn't working and you need a quick fix:

```bash
ssh username@yourdomain.com

# Backup first
cp -r public_html public_html_backup

cd public_html
# Move scf contents to current directory
cp -r scf/* .
rm -rf scf

# Verify structure
ls -la
# Should show: app/, config/, public/, storage/, etc. here
```

Then change cPanel Document Root back to: `public_html`

---

## 📞 Contact Hostinger Support

If nothing works, provide them:

**Subject:** "403 Forbidden on Laravel app - Document Root configuration"

**Message:**
```
Domain: scf.vn
Issue: Getting 403 Forbidden when accessing website

Setup:
- Laravel app located in: public_html/scf/
- Laravel public folder: public_html/scf/public/
- Need Document Root set to: public_html/scf/public/

Current Document Root: public_html (incorrect)
Needed Document Root: public_html/scf/public/

Can you help update the domain configuration?
Alternative: Can we use a .htaccess rewrite rule?
```

---

## ✅ Success Indicators

Once fixed, you should see:

```
✅ https://scf.vn/                  → Home page loads
✅ https://scf.vn/about             → About page loads
✅ https://scf.vn/contact           → Contact page loads
✅ https://scf.vn/blog              → Blog page loads
✅ https://scf.vn/admin             → Admin login page loads
✅ CSS/JS files load (not 403)
✅ Static images load (not 403)
✅ Forms submit without 403 error
✅ Logs show no 403 errors
```

---

## 📝 Key Points

1. **Document Root must point to `public_html/scf/public/`** - This is the #1 cause of 403
2. **Laravel's `public/` folder contains `index.php`** - This MUST be the web entry point
3. **File permissions: 644 for files, 755 for directories** - Already handled by fix script
4. **Apache mod_rewrite must be enabled** - Check with hosting provider
5. **Wait 5-15 minutes** after cPanel changes for servers to update

---

**Last Updated:** November 2025

Your 403 error should be GONE after fixing the Document Root in cPanel! 🚀
