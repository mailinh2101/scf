# Hướng dẫn Site Settings - SCF

## Tổng quan
Hệ thống Site Settings được quản lý thông qua Filament Admin Panel, cho phép cấu hình toàn bộ thông tin website một cách linh hoạt.

## Danh sách Settings đầy đủ

### 1. Thông tin cơ bản
- `site_name` - Tên website (Công ty/Thương hiệu)
- `site_slogan` - Slogan website (Khẩu hiệu)
- `site_domain` - Tên miền (VD: starvik.vn)
- `site_description` - Mô tả ngắn về website (textarea)
- `site_keywords` - Từ khóa SEO (textarea, phân cách bằng dấu phẩy)

### 2. Hình ảnh và Logo
**Type: FileUpload (image)**
- `logo` - Logo chính (Header - PNG/SVG, nền trong suốt)
- `logo_footer` - Logo Footer (PNG/SVG trắng hoặc màu sáng)
- `favicon` - Favicon (Icon 32x32px, 64x64px)
- `og_image` - Ảnh chia sẻ mạng xã hội (Open Graph 1200x630px)
- `placeholder_image` - Ảnh placeholder (hình ảnh mặc định khi không có ảnh)
- `hero_bg` - Hình nền Banner trang chủ
- `hero_image` - Hình ảnh Banner trang chủ
- `about_image` - Ảnh mục Giới thiệu

### 3. Thông tin liên hệ - Email
**Type: Email Input**
- `contact_email` - Email liên hệ chính (info@company.com)
- `contact_email_sales` - Email bán hàng (sales@company.com)
- `contact_email_support` - Email hỗ trợ (support@company.com)

### 4. Thông tin liên hệ - Điện thoại
**Type: Tel Input**
- `contact_phone` - Số điện thoại chính (Hotline)
- `contact_phone_office` - Số điện thoại văn phòng
- `contact_phone_mobile` - Số điện thoại di động
- `zalo_number` - Số Zalo (liên kết chat)
- `whatsapp_number` - Số WhatsApp (liên kết chat)

### 5. Địa chỉ và Bản đồ
**Type: Text/Textarea**
- `office_address` - Địa chỉ văn phòng chính
- `office_address_2` - Địa chỉ chi nhánh 2 (nếu có)
- `warehouse_address` - Địa chỉ kho hàng/nhà máy
- `google_maps_embed` - Mã nhúng Google Maps (textarea, iframe code)
- `google_maps_link` - Link Google Maps (URL)

### 6. Giờ làm việc
**Type: Text Input**
- `working_hours` - Giờ làm việc (VD: 8:00 - 17:30)
- `working_days` - Ngày làm việc (VD: Thứ 2 - Thứ 6)
- `working_hours_saturday` - Giờ làm việc thứ 7 (nếu có)

### 7. Mạng xã hội
**Type: URL Input**
- `facebook_url` - Link Facebook Fanpage
- `youtube_url` - Link Youtube Channel
- `tiktok_url` - Link TikTok
- `linkedin_url` - Link LinkedIn
- `instagram_url` - Link Instagram
- `twitter_url` - Link Twitter/X

### 8. Section trang chủ - Hero Banner
**Type: Text/URL**
- `hero_title` - Tiêu đề Hero Banner
- `hero_subtitle` - Phụ đề Hero Banner
- `hero_button_text` - Text nút Hero (VD: Tìm hiểu thêm)
- `hero_button_link` - Link nút Hero (URL)

### 9. Section trang chủ - Giới thiệu
**Type: Text/Textarea**
- `about_title` - Tiêu đề mục Giới thiệu
- `about_subtitle` - Phụ đề mục Giới thiệu
- `about_content` - Nội dung mục Giới thiệu (textarea)

### 10. Section trang chủ - Sản phẩm/Dịch vụ
**Type: Text Input**
- `product_section_title` - Tiêu đề mục Sản phẩm
- `product_section_subtitle` - Phụ đề mục Sản phẩm
- `service_section_title` - Tiêu đề mục Dịch vụ
- `service_section_subtitle` - Phụ đề mục Dịch vụ

### 11. Section trang chủ - Tin tức
**Type: Text Input**
- `blog_section_title` - Tiêu đề mục Tin tức
- `blog_section_subtitle` - Phụ đề mục Tin tức

### 12. Section trang chủ - Đối tác
**Type: Text Input**
- `partner_section_title` - Tiêu đề mục Đối tác
- `partner_section_subtitle` - Phụ đề mục Đối tác

### 13. Footer
**Type: Textarea/Text**
- `footer_about_text` - Văn bản giới thiệu ngắn ở Footer (textarea)
- `footer_copyright` - Text bản quyền (Copyright)

### 14. Contact CTA (Call To Action)
**Type: Text Input**
- `contact_button_label` - Nhãn nút Liên hệ (VD: Liên hệ ngay)
- `contact_cta_title` - Tiêu đề kêu gọi hành động
- `contact_cta_subtitle` - Phụ đề kêu gọi hành động

### 15. Tracking & Analytics
**Type: Text Input**
- `google_analytics_id` - Google Analytics ID (GA4: G-XXXXXXXXXX)
- `facebook_pixel_id` - Facebook Pixel ID
- `google_tag_manager_id` - Google Tag Manager ID (GTM-XXXXXX)

### 16. Thông tin doanh nghiệp
**Type: Text Input**
- `company_legal_name` - Tên công ty đầy đủ (pháp lý)
- `tax_code` - Mã số thuế
- `business_license` - Số giấy phép kinh doanh
- `founding_year` - Năm thành lập

---

## Cách sử dụng trong Blade Templates

### 1. Lấy tất cả settings
```php
@php
    $siteSettings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();
@endphp
```

### 2. Sử dụng trong template
```blade
{{-- Thông tin cơ bản --}}
<h1>{{ $siteSettings['site_name'] ?? 'SCF' }}</h1>
<p>{{ $siteSettings['site_slogan'] ?? '' }}</p>

{{-- Logo --}}
<img src="{{ asset('storage/' . $siteSettings['logo']) }}" alt="Logo">
<img src="{{ asset('storage/' . $siteSettings['logo_footer']) }}" alt="Logo Footer">

{{-- Thông tin liên hệ --}}
<a href="mailto:{{ $siteSettings['contact_email'] }}">{{ $siteSettings['contact_email'] }}</a>
<a href="tel:{{ $siteSettings['contact_phone'] }}">{{ $siteSettings['contact_phone'] }}</a>

{{-- Địa chỉ --}}
<p>{{ $siteSettings['office_address'] }}</p>

{{-- Giờ làm việc --}}
<p>Giờ làm việc: {{ $siteSettings['working_hours'] }}</p>
<p>{{ $siteSettings['working_days'] }}</p>

{{-- Google Maps --}}
{!! $siteSettings['google_maps_embed'] ?? '' !!}
<a href="{{ $siteSettings['google_maps_link'] }}" target="_blank">Xem trên Google Maps</a>

{{-- Mạng xã hội --}}
<a href="{{ $siteSettings['facebook_url'] }}" target="_blank"><i class="fab fa-facebook"></i></a>
<a href="{{ $siteSettings['youtube_url'] }}" target="_blank"><i class="fab fa-youtube"></i></a>
<a href="{{ $siteSettings['instagram_url'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
<a href="{{ $siteSettings['linkedin_url'] }}" target="_blank"><i class="fab fa-linkedin"></i></a>

{{-- Zalo/WhatsApp Chat --}}
<a href="https://zalo.me/{{ $siteSettings['zalo_number'] }}" target="_blank">Chat Zalo</a>
<a href="https://wa.me/{{ $siteSettings['whatsapp_number'] }}" target="_blank">Chat WhatsApp</a>

{{-- Hero Banner --}}
<section class="hero" style="background-image: url('{{ asset('storage/' . $siteSettings['hero_bg']) }}')">
    <h1>{{ $siteSettings['hero_title'] }}</h1>
    <p>{{ $siteSettings['hero_subtitle'] }}</p>
    <a href="{{ $siteSettings['hero_button_link'] }}">{{ $siteSettings['hero_button_text'] }}</a>
</section>

{{-- Footer Copyright --}}
<p>{{ $siteSettings['footer_copyright'] ?? '© 2024 SCF. All rights reserved.' }}</p>

{{-- Analytics --}}
@if(!empty($siteSettings['google_analytics_id']))
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSettings['google_analytics_id'] }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ $siteSettings['google_analytics_id'] }}');
</script>
@endif
```

### 3. Helper function (tùy chọn)
Bạn có thể tạo helper function trong `app/Helpers/helpers.php`:

```php
if (!function_exists('site_setting')) {
    function site_setting($key, $default = null)
    {
        return \App\Models\SiteSetting::where('key', $key)->value('value') ?? $default;
    }
}
```

Sử dụng:
```blade
{{ site_setting('site_name', 'SCF') }}
{{ site_setting('contact_phone') }}
```

---

## Categories trong Helper

Helper class `SiteSettingsHelper` hỗ trợ lọc theo category:

```php
// Lấy settings theo category
SiteSettingsHelper::getByCategory('basic');       // Thông tin cơ bản
SiteSettingsHelper::getByCategory('images');      // Hình ảnh
SiteSettingsHelper::getByCategory('contact');     // Thông tin liên hệ
SiteSettingsHelper::getByCategory('social_media'); // Mạng xã hội
SiteSettingsHelper::getByCategory('hero');        // Hero banner
SiteSettingsHelper::getByCategory('sections');    // Các section trang chủ
SiteSettingsHelper::getByCategory('tracking');    // Analytics
SiteSettingsHelper::getByCategory('business');    // Thông tin doanh nghiệp
SiteSettingsHelper::getByCategory('footer');      // Footer
```

## Kiểm tra loại field

```php
SiteSettingsHelper::isImageField('logo');          // true
SiteSettingsHelper::isEmailField('contact_email'); // true
SiteSettingsHelper::isPhoneField('contact_phone'); // true
SiteSettingsHelper::isUrlField('facebook_url');    // true
SiteSettingsHelper::isTextareaField('site_description'); // true
```

---

## Deployment lên Production

Sau khi cập nhật settings trong admin panel, chạy lệnh:

```bash
php artisan config:cache
php artisan view:cache
```

---

**Lưu ý:**
- Tất cả file upload sẽ được lưu trong `storage/app/public/site-settings/`
- Cần chạy `php artisan storage:link` để tạo symlink (đã thực hiện)
- Truy cập file: `asset('storage/site-settings/filename.jpg')`
- Hỗ trợ 98 settings khác nhau cho mọi nhu cầu website doanh nghiệp
