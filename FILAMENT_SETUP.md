# Filament Admin Setup Guide

## Quick Start

### 1. Install Filament via Composer
```bash
composer require filament/filament:"^3.*"
```

### 2. Install Filament (if needed, for certain versions)
```bash
php artisan filament:install --panels=admin
```

### 3. Run Migrations
```bash
php artisan migrate
```

### 4. Seed Admin User & Sample Data
```bash
php artisan db:seed --class=FilamentAdminSeeder
php artisan db:seed --class=SampleDataSeeder
```

### 5. Clear Cache & Start Server
```bash
php artisan view:clear
php artisan cache:clear
php artisan serve --host=127.0.0.1 --port=8000
```

### 6. Access Admin Panel
- URL: `http://127.0.0.1:8000/admin`
- Email: `admin@example.com`
- Password: `password` (change immediately!)

## Database Schema

### Products Table
- id
- title
- slug (auto-generated from title)
- description
- price
- image
- published (boolean)
- seo_title
- seo_description
- created_at, updated_at

### Posts Table
- id
- title
- slug (auto-generated)
- excerpt
- content
- featured_image
- published_at
- seo_title
- seo_description
- created_at, updated_at

### Site Settings Table
- id
- key (unique)
- value
- created_at, updated_at

## Common Issues & Solutions

### Issue: Filament command not found
- Ensure you've run `composer require filament/filament:"^3.*"` and `composer dump-autoload`
- Check that `config/app.php` has Filament service providers registered (done automatically)

### Issue: Migration fails
- Check that `.env` DB credentials are correct
- Ensure MySQL is running or SQLite file exists
- Run: `php artisan migrate:refresh` to reset (caution: loses data!)

### Issue: Admin page shows 404
- Ensure Filament is installed and migrations ran successfully
- Check `config/filament/admin.php` for correct path (default: `/admin`)
- Run: `php artisan cache:clear`

## Next Steps
1. Add more fields to resources (e.g., categories, tags)
2. Upload images using MediaLibrary package
3. Set up role-based permissions for users
4. Customize resource pages and dashboards
