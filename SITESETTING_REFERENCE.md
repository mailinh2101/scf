# 🔧 SiteSetting Keys Reference Guide

## Overview

Tất cả cài đặt động (hình ảnh, text, liên hệ) được lưu trong bảng `site_settings` với cấu trúc key-value.

```php
// Cách truy cập trong code:
$value = SiteSetting::where('key', 'contact_email')->first()?->value;
// hoặc
$value = cache('site_settings')['contact_email'] ?? 'default_value';
```

---

## 📋 Danh Sách Tất Cả Keys (Organized by Category)

### 🌍 **GLOBAL - Áp Dụng Toàn Bộ Website**

```php
'site_domain'          // Tên miền (vd: scf.vn)
'site_description'     // Mô tả công ty cho SEO
```

---

### 🎨 **LOGOS & ICONS - Dùng Chung**

```php
'logo_header'          // Logo ở phía trên (Header)
'logo_footer'          // Logo ở phía dưới (Footer)
'sub_logo'             // Logo phụ/Icon nhỏ
'placeholder_image'    // Ảnh mặc định khi hình bị lỗi
```

---

### 📞 **CONTACT PAGE - Trang Liên Hệ**

#### Thông Tin Liên Hệ
```php
'contact_email'        // Email liên hệ
'contact_phone'        // Số điện thoại
'contact_address'      // Địa chỉ văn phòng
'contact_working_hours'// Giờ làm việc
'contact_map_embed'    // Embed iframe Google Maps
```

#### Hình Ảnh
```php
'contact_hero_image'        // Banner hero ảnh chính
'contact_hero_decoration'   // Banner hero trang trí
'contact_section_image_left'  // Ảnh bên trái phần thông tin
'contact_section_image_right' // Ảnh bên phải phần thông tin
```

---

### 📰 **BLOG PAGE - Trang Tin Tức**

#### Text Content
```php
'blog_section_title'     // Tiêu đề mục Blog (mặc định: "Tin tức & bài viết")
'blog_section_subtitle'  // Mô tả mục Blog
```

#### Hình Ảnh
```php
'blog_hero_image'       // Banner hero ảnh chính
'blog_hero_decoration'  // Banner hero trang trí
```

---

### 💼 **CAREERS PAGE - Trang Tuyển Dụng**

```php
'careers_hero_image'       // Banner hero ảnh chính
'careers_hero_decoration'  // Banner hero trang trí
```

---

### 🛍️ **PRODUCTS PAGE - Trang Sản Phẩm**

```php
'products_hero_image'       // Banner hero ảnh chính
'products_hero_decoration'  // Banner hero trang trí
```

---

### ℹ️ **ABOUT PAGE - Trang Giới Thiệu**

```php
'about_hero_image'       // Banner hero ảnh chính
'about_hero_decoration'  // Banner hero trang trí
```

---

### 🏠 **HOME PAGE - Trang Chủ**

```php
'home_hero_background'  // Ảnh nền phần hero
'home_hero_image'       // Ảnh chính phần hero
'home_hero_decoration'  // Trang trí phần hero
```

---

### 🦶 **FOOTER - Dùng Chung Tất Cả Trang**

```php
'footer_decoration_image'  // Hình trang trí footer
```

---

### 🏷️ **LABELS - Nội Dung Văn Bản (Button Labels)**

```php
'button_contact_label'     // Text nút "Liên hệ"
'button_read_more_label'   // Text nút "Đọc thêm" (Blog, Products)
'button_learn_more_label'  // Text nút "Tìm hiểu thêm"
```

---

## 🖼️ Image Keys (Auto-Converted to URLs)

Các keys này tự động được chuyển đổi thành full URL bởi `AssetHelper::assetUrl()`:

```php
'logo_header'
'logo_footer'
'sub_logo'
'placeholder_image'
'home_hero_background'
'home_hero_image'
'home_hero_decoration'
'contact_hero_image'
'contact_hero_decoration'
'contact_section_image_left'
'contact_section_image_right'
'blog_hero_image'
'blog_hero_decoration'
'careers_hero_image'
'careers_hero_decoration'
'products_hero_image'
'products_hero_decoration'
'about_hero_image'
'about_hero_decoration'
'footer_decoration_image'
```

---

## 💾 Cách Sử Dụng Trong Code

### **1. Lấy giá trị đơn giản**

```php
// Trong Controller
$email = SiteSetting::getValue('contact_email');

// Trong Blade
{{ $siteSettings['contact_email'] ?? 'default@example.com' }}
```

### **2. Lấy URL ảnh**

```php
// Nếu key là image, tự động convert thành URL
{{ $siteSettings['contact_hero_image'] }}
// Output: https://scf.vn/storage/images/hero-img1.png
```

### **3. Sử dụng Helper**

```php
{{ asset_url($siteSettings['contact_hero_image'] ?? 'images/hero-img1.png') }}
```

### **4. Cache**

```php
$settings = cache('site_settings');
echo $settings['contact_email'];
```

---

## 🔄 Database Migration

Khi thêm key mới, cần:

1. **Update `SampleDataSeeder.php`** - Thêm entry mới
2. **Update `SiteSetting` model** - Thêm vào `$imageKeys` nếu là hình ảnh
3. **Create Migration** (nếu cần thay đổi schema)
4. **Seed lại database**:
   ```bash
   php artisan db:seed --class=SampleDataSeeder
   ```

---

## ✅ Naming Convention

### **Format: `{page}_{element_type}_{purpose}`**

- `page`: home, contact, blog, careers, products, about, footer
- `element_type`: hero, section, button
- `purpose`: image, decoration, title, subtitle, label

### **Ví Dụ:**
- ✅ `contact_hero_image` - Ảnh chính (hero) trang Contact
- ✅ `blog_section_title` - Tiêu đề (title) phần (section) Blog
- ✅ `button_contact_label` - Text nút Contact
- ❌ `contact_img` - Quá ngắn, không rõ vị trí
- ❌ `img_1_hero` - Thứ tự sai, khó sắp xếp

---

## 🎯 Migration Checklist Khi Thêm Setting Mới

- [ ] Thêm vào `database/seeders/SampleDataSeeder.php` với comment Tiếng Việt
- [ ] Thêm vào `app/Models/SiteSetting.php` nếu là image key
- [ ] Update `SETTINGS_GUIDE_VI.md` với hướng dẫn người dùng
- [ ] Test trong Blade view trước khi merge
- [ ] Run `php artisan db:seed --class=SampleDataSeeder`
- [ ] Clear cache: `php artisan cache:clear`

---

## 🚀 Example: Thêm Setting Mới

**Bước 1:** Update seeder

```php
// database/seeders/SampleDataSeeder.php
['key' => 'new_page_setting_name', 'value' => 'default_value'],
```

**Bước 2:** Nếu là image, update model

```php
// app/Models/SiteSetting.php
protected static array $imageKeys = [
    // ... existing keys ...
    'new_page_setting_name',  // Add new key
];
```

**Bước 3:** Dùng trong view

```blade
{{ $siteSettings['new_page_setting_name'] ?? 'fallback_value' }}
```

---

## 📊 Statistics

- **Total Settings:** 42+
- **Image Keys:** 20
- **Text Keys:** 22
- **Pages Configured:** 7 (Home, Contact, Blog, Careers, Products, About, Global)
- **Categories:** 10

---

## 📞 Support

Liên hệ tại: `hr03.gr@gmail.com` hoặc `0902.381.851`
