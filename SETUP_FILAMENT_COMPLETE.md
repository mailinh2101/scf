# Filament Admin Setup Instructions

## Automated Setup Steps (Run These Locally)

### 1. Install Filament & Dependencies
```powershell
cd E:\xampp\htdocs\starvik
composer require filament/filament
```

**If prompted for specific version**, ensure you're on Laravel 10+:
```powershell
composer require "filament/filament:^3.*"
```

### 2. Install Filament (First Time Setup)
```powershell
php artisan filament:install --panels=admin
```

This will:
- Publish Filament config files
- Create the admin panel at `/admin`
- Set up default routes

### 3. Run Database Migrations
```powershell
php artisan migrate
```

Expected tables created:
- `products`
- `posts`
- `site_settings`
- (plus Laravel default tables)

### 4. Seed Sample Data
```powershell
php artisan db:seed --class=FilamentAdminSeeder
php artisan db:seed --class=SampleDataSeeder
```

This creates:
- 1 admin user: `admin@example.com` / `password`
- 5 sample products
- 3 sample blog posts
- 6 global site settings

### 5. Clear Caches & Start Dev Server
```powershell
php artisan view:clear
php artisan cache:clear
php artisan serve --host=127.0.0.1 --port=8000
```

### 6. Access Filament Admin
- URL: http://127.0.0.1:8000/admin
- Email: `admin@example.com`
- Password: `password`

**⚠️ Security**: Change password immediately after first login!

---

## Verification Checklist

After setup, verify these pages work:

### Front-End Pages (DB-Driven)
- ✅ `/san-pham` — displays 5 products from DB
- ✅ `/tin-tuc` — displays 3 blog posts from DB
- ✅ `/tin-tuc/{slug}` — displays single post with content
- ✅ `/` (home) — displays without DB calls (static)

### Filament Admin Pages
- ✅ `/admin` — login page
- ✅ `/admin/products` — CRUD for products
- ✅ `/admin/posts` — CRUD for blog posts
- ✅ `/admin/site-settings` — CRUD for global settings

---

## Database Structure

### `products` Table
```
id (bigint, primary)
title (string) — product name
slug (string, unique) — auto-generated from title
description (text)
price (decimal)
image (string) — path to product image
published (boolean) — visibility toggle
seo_title (string)
seo_description (text)
created_at, updated_at
```

### `posts` Table
```
id (bigint, primary)
title (string) — article headline
slug (string, unique) — auto-generated from title
excerpt (text) — short summary
content (longtext) — full article HTML/markup
featured_image (string) — hero image path
published_at (timestamp, nullable) — schedule/publish date
seo_title (string)
seo_description (text)
created_at, updated_at
```

### `site_settings` Table
```
id (bigint, primary)
key (string, unique) — setting name (e.g., 'site_title')
value (text) — setting value
created_at, updated_at
```

---

## Troubleshooting

### Issue: "Class 'Filament\Facades\Filament' not found"
**Solution:** Run `composer dump-autoload`

### Issue: Migration fails with "Access denied"
**Solution:** Check `.env` database credentials:
```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=starvik
DB_USERNAME=root
DB_PASSWORD=
```

### Issue: `/admin` shows 404
**Solution:**
1. Ensure Filament migrations ran: `php artisan migrate`
2. Clear routes cache: `php artisan route:clear`
3. Republish assets: `php artisan vendor:publish --tag=filament-assets`

### Issue: Admin resources not showing
**Solution:** Ensure you're logged in and the resources are registered in Filament. Check `app/Filament/Resources/` folder for Resource classes.

---

## File References

- Models: `app/Models/Product.php`, `app/Models/Post.php`, `app/Models/SiteSetting.php`
- Migrations: `database/migrations/2025_11_05_000001_create_products_table.php` etc.
- Controllers: `app/Http/Controllers/ProductController.php`, `app/Http/Controllers/PostController.php`
- Filament Resources: `app/Filament/Resources/ProductResource.php` etc.
- Views (DB-driven): `resources/views/products.blade.php`, `resources/views/blog.blade.php`, `resources/views/blog-post.blade.php`

---

## Next Steps

After successful setup:

1. **Customize Filament Resources**
   - Add image upload (install `filament/spatie-laravel-media-library`)
   - Add categories, tags, or other relations
   - Customize table columns and form fields

2. **Add More SEO Fields** (optional)
   - Add `meta_keywords`, `canonical_url` to products/posts
   - Create a dedicated SEO resource in Filament

3. **Implement Full-Text Search** (optional)
   - Add search filters to product/post resources
   - Use Laravel Scout or simple LIKE queries

4. **Set Up Backups** (optional)
   - Configure automated DB backups
   - Document recovery procedures

---

## Support & Resources

- Laravel Docs: https://laravel.com/docs
- Filament Docs: https://filamentphp.com
- Eloquent ORM: https://laravel.com/docs/11.x/eloquent
