#!/bin/bash

################################################################################
# Laravel Deployment Script for Hostinger (SSH)
# Usage: ./deploy.sh [production|staging]
# Features:
# - Composer v2 installation (workaround for Hostinger v1 limitation)
# - Automatic backup creation
# - Database migrations
# - Cache clearing and optimization
# - Permission configuration
# - Error handling and logging
################################################################################

set -e  # Exit on error

# Configuration
ENVIRONMENT=${1:-production}
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
LOG_FILE="deploy_${TIMESTAMP}.log"
BACKUP_DIR="backups/deployment_${TIMESTAMP}"
PROJECT_ROOT="."

# Color output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

################################################################################
# Helper Functions
################################################################################

log_info() {
    echo -e "${BLUE}[INFO]${NC} $1" | tee -a "$LOG_FILE"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1" | tee -a "$LOG_FILE"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1" | tee -a "$LOG_FILE"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1" | tee -a "$LOG_FILE"
}

exit_on_error() {
    if [ $? -ne 0 ]; then
        log_error "$1"
        exit 1
    fi
}

################################################################################
# Pre-Deployment Checks
################################################################################

echo -e "${BLUE}═══════════════════════════════════════════════════════════${NC}"
echo -e "${BLUE}     Laravel Deployment Script for Hostinger (SSH)${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════════${NC}"
echo ""

log_info "Starting deployment process..."
log_info "Environment: $ENVIRONMENT"
log_info "Log file: $LOG_FILE"
echo ""

# Check if we're in the project root
if [ ! -f "artisan" ]; then
    log_error "artisan file not found. Please run this script from the project root directory."
    exit 1
fi

log_success "Project root verified"

# Check PHP version
log_info "Checking PHP version..."
PHP_VERSION=$(php -v | head -n 1)
log_info "PHP: $PHP_VERSION"

# Check if composer exists
if ! command -v composer &> /dev/null; then
    log_warning "Composer not found in PATH. Checking for local composer.phar..."
    if [ ! -f "composer.phar" ]; then
        log_warning "Downloading Composer v2..."
        php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
        php composer-setup.php --2 --quiet
        exit_on_error "Failed to download Composer"
        rm composer-setup.php
        log_success "Composer v2 installed locally"
    fi
    COMPOSER="php composer.phar"
else
    COMPOSER="composer"
    COMPOSER_VERSION=$($COMPOSER --version)
    log_info "Composer: $COMPOSER_VERSION"
fi

################################################################################
# Backup Current State
################################################################################

echo ""
log_info "Creating backup before deployment..."

mkdir -p "$BACKUP_DIR"

# Backup .env
if [ -f ".env" ]; then
    cp ".env" "$BACKUP_DIR/.env.backup"
    log_success "Backed up .env"
fi

# Backup storage directory
if [ -d "storage" ]; then
    cp -r storage "$BACKUP_DIR/storage_backup" 2>/dev/null || true
    log_success "Backed up storage directory"
fi

# Backup database (optional - if MySQL available)
if command -v mysqldump &> /dev/null; then
    log_info "Attempting database backup..."
    if [ -f ".env" ]; then
        DB_HOST=$(grep DB_HOST .env | cut -d '=' -f2)
        DB_USER=$(grep DB_USERNAME .env | cut -d '=' -f2)
        DB_PASS=$(grep DB_PASSWORD .env | cut -d '=' -f2)
        DB_NAME=$(grep DB_DATABASE .env | cut -d '=' -f2)
        
        mysqldump -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" > "$BACKUP_DIR/database_backup.sql" 2>/dev/null || true
        if [ -f "$BACKUP_DIR/database_backup.sql" ]; then
            log_success "Database backed up"
        fi
    fi
else
    log_warning "mysqldump not available - skipping database backup"
fi

################################################################################
# Pull Latest Code
################################################################################

echo ""
log_info "Pulling latest code from repository..."

if [ -d ".git" ]; then
    git pull origin main 2>&1 | tee -a "$LOG_FILE"
    exit_on_error "Failed to pull from repository"
    log_success "Code pulled successfully"
else
    log_warning "Git repository not found - skipping git pull"
fi

################################################################################
# Install Dependencies
################################################################################

echo ""
log_info "Installing PHP dependencies (this may take a few minutes)..."

$COMPOSER install --no-dev --optimize-autoloader 2>&1 | tee -a "$LOG_FILE"
exit_on_error "Composer install failed"

log_success "PHP dependencies installed"

################################################################################
# Environment Setup
################################################################################

echo ""
log_info "Setting up environment..."

if [ ! -f ".env" ]; then
    log_warning ".env file not found - copying from .env.example"
    cp .env.example .env
    exit_on_error "Failed to copy .env.example"
    log_warning "Please update .env with correct configuration values!"
fi

# Generate app key if missing
if ! grep -q "APP_KEY=base64:" .env; then
    log_info "Generating APP_KEY..."
    php artisan key:generate --force 2>&1 | tee -a "$LOG_FILE"
    exit_on_error "Failed to generate APP_KEY"
    log_success "APP_KEY generated"
fi

################################################################################
# Database Migrations
################################################################################

echo ""
log_info "Running database migrations..."

php artisan migrate --force 2>&1 | tee -a "$LOG_FILE"
exit_on_error "Migration failed"

log_success "Database migrations completed"

################################################################################
# File Permissions
################################################################################

echo ""
log_info "Setting file permissions..."

# Storage directory
chmod -R 775 storage bootstrap/cache 2>&1 | tee -a "$LOG_FILE"
exit_on_error "Failed to set storage permissions"

log_success "File permissions configured"

################################################################################
# Create Storage Symlink
################################################################################

echo ""
log_info "Creating storage symlink..."

php artisan storage:link 2>&1 | tee -a "$LOG_FILE" || log_warning "Storage symlink already exists or creation failed"

log_success "Storage link ready"

################################################################################
# Cache Management
################################################################################

echo ""
log_info "Clearing and rebuilding cache..."

php artisan config:cache 2>&1 | tee -a "$LOG_FILE"
php artisan route:cache 2>&1 | tee -a "$LOG_FILE"
php artisan view:cache 2>&1 | tee -a "$LOG_FILE"

log_success "Cache rebuilt"

################################################################################
# NPM Assets (Optional)
################################################################################

if [ -f "package.json" ]; then
    echo ""
    log_info "Building frontend assets..."
    
    if command -v npm &> /dev/null; then
        npm ci --omit=dev 2>&1 | tee -a "$LOG_FILE" || log_warning "npm ci failed - attempting npm install"
        npm run build 2>&1 | tee -a "$LOG_FILE" || log_warning "npm run build may have failed"
        log_success "Assets built"
    else
        log_warning "npm not found - skipping asset build (run 'npm run build' locally and upload)"
    fi
fi

################################################################################
# Deployment Summary
################################################################################

echo ""
echo -e "${BLUE}═══════════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✓ Deployment completed successfully!${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════════${NC}"
echo ""
echo "Summary:"
echo "  • Environment: $ENVIRONMENT"
echo "  • Timestamp: $TIMESTAMP"
echo "  • Log file: $LOG_FILE"
echo "  • Backup location: $BACKUP_DIR"
echo ""
echo "Post-Deployment Steps:"
echo "  1. Verify application is running: curl https://yourdomain.com"
echo "  2. Check error logs: tail -f storage/logs/laravel.log"
echo "  3. Review backup location: $BACKUP_DIR"
echo ""
echo -e "${YELLOW}Note: If issues occur, restore from backup:${NC}"
echo "  cp $BACKUP_DIR/.env .env"
echo "  cp -r $BACKUP_DIR/storage/* storage/"
echo "  php artisan migrate:rollback"
echo ""

log_success "Deployment process finished"

################################################################################
# Post-Deployment Optional Tasks
################################################################################

read -p "Run database seeder? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    log_info "Running database seeders..."
    php artisan db:seed --force 2>&1 | tee -a "$LOG_FILE"
    log_success "Seeders completed"
fi

read -p "Restart application queue? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    if command -v supervisorctl &> /dev/null; then
        log_info "Restarting supervisord queue..."
        supervisorctl restart laravel-worker 2>&1 | tee -a "$LOG_FILE" || log_warning "Queue restart may have failed"
        log_success "Queue restarted"
    else
        log_warning "Supervisor not configured - skipping queue restart"
    fi
fi

################################################################################
# Rollback Instructions
################################################################################

echo ""
echo -e "${YELLOW}═══════════════════════════════════════════════════════════${NC}"
echo -e "${YELLOW}Rollback Instructions (if deployment fails):${NC}"
echo -e "${YELLOW}═══════════════════════════════════════════════════════════${NC}"
echo ""
echo "Restore .env:"
echo "  cp $BACKUP_DIR/.env.backup .env"
echo ""
echo "Restore storage:"
echo "  cp -r $BACKUP_DIR/storage_backup/* storage/"
echo ""
echo "Rollback database:"
echo "  php artisan migrate:rollback"
echo ""
echo "Or restore database from backup:"
echo "  mysql -h DB_HOST -u DB_USER -p DB_NAME < $BACKUP_DIR/database_backup.sql"
echo ""

exit 0
