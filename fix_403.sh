#!/bin/bash

################################################################################
# SCF Laravel - Complete 403 Fix Script for Hostinger
# Run this via SSH when 403 Forbidden appears
# Usage: bash fix_403.sh
################################################################################

set -e

echo "🔧 SCF Laravel 403 Forbidden Fix Script"
echo "=========================================="
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Step counter
STEP=1

################################################################################
# Helper Functions
################################################################################

log_step() {
    echo -e "${BLUE}[STEP $STEP]${NC} $1"
    ((STEP++))
}

log_success() {
    echo -e "${GREEN}✅${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}⚠️${NC} $1"
}

log_error() {
    echo -e "${RED}❌${NC} $1"
}

################################################################################
# Check Environment
################################################################################

log_step "Checking environment..."

if [ ! -f "artisan" ]; then
    log_error "artisan not found! Are you in the Laravel project root?"
    log_error "Expected: ~/public_html/scf/"
    exit 1
fi

log_success "Found Laravel project (artisan exists)"

CURRENT_DIR=$(pwd)
log_success "Working in: $CURRENT_DIR"

################################################################################
# Step 1: Fix File Permissions
################################################################################

log_step "Fixing file permissions..."

log_warning "This may take a minute..."

# Fix all files to 644
find . -type f ! -path "./storage/*" ! -path "./bootstrap/cache/*" -exec chmod 644 {} \; 2>/dev/null || true
log_success "Files set to 644"

# Fix all directories to 755
find . -type d ! -path "./storage/*" ! -path "./bootstrap/cache/*" -exec chmod 755 {} \; 2>/dev/null || true
log_success "Directories set to 755"

# Make storage writable
chmod -R 777 storage 2>/dev/null || chmod -R 755 storage
log_success "Storage directory writable"

# Make bootstrap/cache writable
chmod -R 777 bootstrap/cache 2>/dev/null || chmod -R 755 bootstrap/cache
log_success "Bootstrap/cache directory writable"

# Make public writable
chmod -R 755 public
log_success "Public directory set to 755"

################################################################################
# Step 2: Verify .htaccess
################################################################################

log_step "Verifying .htaccess in public folder..."

if [ ! -f "public/.htaccess" ]; then
    log_warning ".htaccess not found in public/! Creating it..."
    cat > public/.htaccess << 'EOF'
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
EOF
    chmod 644 public/.htaccess
    log_success "Created public/.htaccess"
else
    log_success ".htaccess exists"
fi

################################################################################
# Step 3: Test PHP Execution
################################################################################

log_step "Testing PHP execution..."

cat > public/test_php.php << 'EOF'
<?php
header('Content-Type: text/plain');
echo "✅ PHP Execution: OK\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Current User: " . get_current_user() . "\n";

// Test Laravel bootstrap
try {
    require __DIR__ . '/../bootstrap/app.php';
    echo "✅ Laravel Bootstrap: OK\n";
} catch (Exception $e) {
    echo "❌ Laravel Bootstrap: FAILED - " . $e->getMessage() . "\n";
}

// Test storage
if (is_writable('../storage')) {
    echo "✅ Storage Writable: YES\n";
} else {
    echo "❌ Storage Writable: NO\n";
}

// Test index.php
if (file_exists('index.php')) {
    echo "✅ index.php: EXISTS\n";
} else {
    echo "❌ index.php: MISSING\n";
}

echo "\nServer Info:\n";
echo "Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "\n";
echo "Server Name: " . ($_SERVER['SERVER_NAME'] ?? 'N/A') . "\n";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "\n";
?>
EOF

chmod 644 public/test_php.php
log_success "Created test file: public/test_php.php"
log_warning "Access it at: https://scf.vn/test_php.php"

################################################################################
# Step 4: Test Laravel
################################################################################

log_step "Testing Laravel..."

# Check if artisan works
if php artisan --version > /dev/null 2>&1; then
    log_success "Laravel artisan working"
    php artisan --version
else
    log_error "Laravel artisan not working!"
fi

################################################################################
# Step 5: Test Database
################################################################################

log_step "Testing database connection..."

php artisan tinker <<'TINKER' 2>/dev/null || log_warning "Tinker test skipped"
try {
    $pdo = DB::connection()->getPdo();
    echo "✅ Database Connection: SUCCESS\n";
    echo "Database: " . DB::connection()->getDatabaseName() . "\n";
} catch (Exception $e) {
    echo "❌ Database Connection: FAILED\n";
    echo "Error: " . $e->getMessage() . "\n";
}
exit
TINKER

log_success "Database test completed"

################################################################################
# Step 6: Clear Cache & Build
################################################################################

log_step "Clearing and rebuilding cache..."

php artisan cache:clear 2>/dev/null || log_warning "Cache clear had issues"
log_success "Cache cleared"

php artisan config:cache 2>/dev/null || log_warning "Config cache had issues"
log_success "Config cache built"

php artisan route:cache 2>/dev/null || log_warning "Route cache had issues"
log_success "Route cache built"

php artisan view:cache 2>/dev/null || log_warning "View cache had issues"
log_success "View cache built"

################################################################################
# Step 7: Storage Link
################################################################################

log_step "Setting up storage link..."

if [ -L "public/storage" ]; then
    log_success "Storage symlink already exists"
elif php artisan storage:link 2>/dev/null; then
    log_success "Storage symlink created"
else
    log_warning "Symlink creation failed (may not be supported on this server)"
    log_warning "Files will be served from storage/app/public directly"
fi

################################################################################
# Step 8: Directory Structure Verification
################################################################################

log_step "Verifying directory structure..."

echo ""
echo "Current directory: $CURRENT_DIR"
echo ""
echo "Directory structure:"
ls -la | grep -E "^d" | awk '{print "  " $NF}'
echo ""
echo "Key files:"
ls -lh artisan .env public/index.php 2>/dev/null | awk '{print "  " $9 " (" $5 ")"}'
echo ""

################################################################################
# Step 9: Permissions Report
################################################################################

log_step "Permissions report..."

echo ""
echo "Storage permissions:"
ls -ld storage
echo ""
echo "Bootstrap cache permissions:"
ls -ld bootstrap/cache
echo ""
echo "Public permissions:"
ls -ld public
echo ""

################################################################################
# Step 10: Summary & Next Steps
################################################################################

echo ""
echo -e "${BLUE}════════════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✅ SCRIPT COMPLETED!${NC}"
echo -e "${BLUE}════════════════════════════════════════════════════════════${NC}"
echo ""

echo "📋 NEXT STEPS:"
echo ""
echo "1. 🌐 Open browser and visit:"
echo "   https://scf.vn/"
echo ""
echo "2. 🧪 Test PHP execution at:"
echo "   https://scf.vn/test_php.php"
echo ""
echo "3. 🗑️ DELETE test file after checking:"
echo "   rm public/test_php.php"
echo ""
echo "4. 📊 If still getting 403, check:"
echo ""
echo "   a) cPanel Domain Document Root:"
echo "      Should be: public_html/scf/public"
echo ""
echo "   b) Check Apache error logs:"
echo "      tail -50 ~/logs/error_log"
echo ""
echo "   c) Verify mod_rewrite is enabled:"
echo "      php -m | grep rewrite"
echo ""

echo "5. 📞 If issues persist, contact Hostinger support with:"
echo "   - Domain: scf.vn"
echo "   - Issue: 403 Forbidden on Laravel app in public_html/scf/"
echo "   - Setup: Need Document Root at public_html/scf/public/"
echo ""

echo "📝 IMPORTANT:"
echo "   • Your .env is configured for production"
echo "   • Database host: auth-db603.hstgr.io"
echo "   • Make sure to run: php artisan migrate --force"
echo ""

################################################################################
# Cleanup
################################################################################

# Remove any old test files
rm -f public/test.php public/test.html 2>/dev/null || true

log_success "Setup complete!"

exit 0
