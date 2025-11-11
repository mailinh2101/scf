<?php

namespace App\Helpers;

/**
 * Site Settings Helper
 * 
 * Quản lý tất cả các cài đặt site được sử dụng trong ứng dụng
 * Cung cấp gợi ý cho người dùng khi cấu hình cài đặt mới
 */
class SiteSettingsHelper
{
    /**
     * Danh sách tất cả các site settings được sử dụng
     * Key: tên cài đặt trong database
     * Value: mô tả/nhãn cho người dùng
     */
    public static array $predefinedSettings = [
        // Thông tin cơ bản
        'site_name' => 'Tên website (Công ty/Thương hiệu)',
        'site_slogan' => 'Slogan website (Khẩu hiệu)',
        'site_domain' => 'Tên miền (VD: starvik.vn)',
        'site_description' => 'Mô tả ngắn về website (hiển thị ở footer, meta description)',
        'site_keywords' => 'Từ khóa SEO (phân cách bằng dấu phẩy)',
        
        // Hình ảnh và logo (upload file)
        'logo' => 'Logo chính (Header - PNG/SVG, nền trong suốt)',
        'logo_footer' => 'Logo Footer (PNG/SVG trắng hoặc màu sáng)',
        'favicon' => 'Favicon (Icon 32x32px, 64x64px)',
        'og_image' => 'Ảnh chia sẻ mạng xã hội (Open Graph 1200x630px)',
        'placeholder_image' => 'Ảnh placeholder (hình ảnh mặc định khi không có ảnh)',
        'hero_bg' => 'Hình nền Banner trang chủ (Hero background)',
        'hero_image' => 'Hình ảnh Banner trang chủ (Hero image)',
        'about_image' => 'Ảnh mục Giới thiệu (About us)',
        
        // Thông tin liên hệ - Email
        'contact_email' => 'Email liên hệ chính (info@company.com)',
        'contact_email_sales' => 'Email bán hàng (sales@company.com)',
        'contact_email_support' => 'Email hỗ trợ (support@company.com)',
        
        // Thông tin liên hệ - Điện thoại
        'contact_phone' => 'Số điện thoại chính (Hotline)',
        'contact_phone_office' => 'Số điện thoại văn phòng',
        'contact_phone_mobile' => 'Số điện thoại di động',
        'zalo_number' => 'Số Zalo (liên kết chat)',
        'whatsapp_number' => 'Số WhatsApp (liên kết chat)',
        
        // Địa chỉ
        'office_address' => 'Địa chỉ văn phòng chính',
        'office_address_2' => 'Địa chỉ chi nhánh 2 (nếu có)',
        'warehouse_address' => 'Địa chỉ kho hàng/nhà máy',
        'google_maps_embed' => 'Mã nhúng Google Maps (iframe)',
        'google_maps_link' => 'Link Google Maps (URL)',
        
        // Giờ làm việc
        'working_hours' => 'Giờ làm việc (VD: 8:00 - 17:30)',
        'working_days' => 'Ngày làm việc (VD: Thứ 2 - Thứ 6)',
        'working_hours_saturday' => 'Giờ làm việc thứ 7 (nếu có)',
        
        // Mạng xã hội
        'facebook_url' => 'Link Facebook Fanpage',
        'youtube_url' => 'Link Youtube Channel',
        'tiktok_url' => 'Link TikTok',
        'linkedin_url' => 'Link LinkedIn',
        'instagram_url' => 'Link Instagram',
        'twitter_url' => 'Link Twitter/X',
        
        // Section trang chủ - Hero
        'hero_title' => 'Tiêu đề Hero Banner (trang chủ)',
        'hero_subtitle' => 'Phụ đề Hero Banner',
        'hero_button_text' => 'Text nút Hero (VD: Tìm hiểu thêm)',
        'hero_button_link' => 'Link nút Hero',
        
        // Section trang chủ - Giới thiệu
        'about_title' => 'Tiêu đề mục Giới thiệu',
        'about_subtitle' => 'Phụ đề mục Giới thiệu',
        'about_content' => 'Nội dung mục Giới thiệu (văn bản ngắn)',
        
        // Section trang chủ - Sản phẩm/Dịch vụ
        'product_section_title' => 'Tiêu đề mục Sản phẩm',
        'product_section_subtitle' => 'Phụ đề mục Sản phẩm',
        'service_section_title' => 'Tiêu đề mục Dịch vụ',
        'service_section_subtitle' => 'Phụ đề mục Dịch vụ',
        
        // Section trang chủ - Tin tức
        'blog_section_title' => 'Tiêu đề mục Tin tức',
        'blog_section_subtitle' => 'Phụ đề mục Tin tức',
        
        // Section trang chủ - Đối tác
        'partner_section_title' => 'Tiêu đề mục Đối tác',
        'partner_section_subtitle' => 'Phụ đề mục Đối tác',
        
        // Footer
        'footer_about_text' => 'Văn bản giới thiệu ngắn ở Footer',
        'footer_copyright' => 'Text bản quyền (Copyright)',
        
        // Contact CTA
        'contact_button_label' => 'Nhãn nút Liên hệ (VD: Liên hệ ngay)',
        'contact_cta_title' => 'Tiêu đề kêu gọi hành động (CTA)',
        'contact_cta_subtitle' => 'Phụ đề kêu gọi hành động',
        
        // Tracking & Analytics
        'google_analytics_id' => 'Google Analytics ID (GA4: G-XXXXXXXXXX)',
        'facebook_pixel_id' => 'Facebook Pixel ID',
        'google_tag_manager_id' => 'Google Tag Manager ID (GTM-XXXXXX)',
        
        // Business Info
        'company_legal_name' => 'Tên công ty đầy đủ (pháp lý)',
        'tax_code' => 'Mã số thuế',
        'business_license' => 'Số giấy phép kinh doanh',
        'founding_year' => 'Năm thành lập',
    ];

    /**
     * Danh sách các field là hình ảnh/file
     */
    public static array $imageFields = [
        'logo',
        'logo_footer',
        'favicon',
        'og_image',
        'placeholder_image',
        'hero_bg',
        'hero_image',
        'about_image',
    ];

    /**
     * Danh sách các field là email
     */
    public static array $emailFields = [
        'contact_email',
        'contact_email_sales',
        'contact_email_support',
    ];

    /**
     * Danh sách các field là điện thoại
     */
    public static array $phoneFields = [
        'contact_phone',
        'contact_phone_office',
        'contact_phone_mobile',
        'zalo_number',
        'whatsapp_number',
    ];

    /**
     * Danh sách các field là URL/Link
     */
    public static array $urlFields = [
        'facebook_url',
        'youtube_url',
        'tiktok_url',
        'linkedin_url',
        'instagram_url',
        'twitter_url',
        'google_maps_link',
        'hero_button_link',
    ];

    /**
     * Danh sách các field là textarea (văn bản dài)
     */
    public static array $textareaFields = [
        'site_description',
        'site_keywords',
        'google_maps_embed',
        'about_content',
        'footer_about_text',
    ];

    /**
     * Lấy danh sách tất cả cài đặt được định nghĩa
     * 
     * @return array
     */
    public static function getAll(): array
    {
        return self::$predefinedSettings;
    }

    /**
     * Lấy mô tả của một cài đặt
     * 
     * @param string $key
     * @return string
     */
    public static function getDescription(string $key): string
    {
        return self::$predefinedSettings[$key] ?? $key;
    }

    /**
     * Kiểm tra một cài đặt có được định nghĩa không
     * 
     * @param string $key
     * @return bool
     */
    public static function isDefined(string $key): bool
    {
        return isset(self::$predefinedSettings[$key]);
    }

    /**
     * Lấy các cài đặt theo category
     * 
     * @param string $category ('basic', 'images', 'contact', 'social_media', 'hero', 'sections', 'tracking', 'business')
     * @return array
     */
    public static function getByCategory(string $category): array
    {
        $settings = [];
        
        match ($category) {
            'basic' => $settings = array_filter(self::$predefinedSettings, 
                fn($key) => in_array($key, ['site_name', 'site_slogan', 'site_domain', 'site_description', 'site_keywords']), 
                ARRAY_FILTER_USE_KEY),
            'images' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => self::isImageField($key),
                ARRAY_FILTER_USE_KEY),
            'contact' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, [
                    'contact_email', 'contact_email_sales', 'contact_email_support',
                    'contact_phone', 'contact_phone_office', 'contact_phone_mobile',
                    'zalo_number', 'whatsapp_number',
                    'office_address', 'office_address_2', 'warehouse_address',
                    'google_maps_embed', 'google_maps_link',
                    'working_hours', 'working_days', 'working_hours_saturday',
                    'contact_button_label', 'contact_cta_title', 'contact_cta_subtitle'
                ]),
                ARRAY_FILTER_USE_KEY),
            'social_media' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, [
                    'facebook_url', 'youtube_url', 'tiktok_url', 
                    'linkedin_url', 'instagram_url', 'twitter_url'
                ]),
                ARRAY_FILTER_USE_KEY),
            'hero' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['hero_title', 'hero_subtitle', 'hero_button_text', 'hero_button_link']),
                ARRAY_FILTER_USE_KEY),
            'sections' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, [
                    'about_title', 'about_subtitle', 'about_content',
                    'product_section_title', 'product_section_subtitle',
                    'service_section_title', 'service_section_subtitle',
                    'blog_section_title', 'blog_section_subtitle',
                    'partner_section_title', 'partner_section_subtitle'
                ]),
                ARRAY_FILTER_USE_KEY),
            'tracking' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['google_analytics_id', 'facebook_pixel_id', 'google_tag_manager_id']),
                ARRAY_FILTER_USE_KEY),
            'business' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['company_legal_name', 'tax_code', 'business_license', 'founding_year']),
                ARRAY_FILTER_USE_KEY),
            'footer' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['footer_about_text', 'footer_copyright']),
                ARRAY_FILTER_USE_KEY),
            default => $settings = self::$predefinedSettings,
        };

        return $settings;
    }

    /**
     * Lấy tất cả các key
     * 
     * @return array
     */
    public static function getKeys(): array
    {
        return array_keys(self::$predefinedSettings);
    }

    /**
     * Lấy tất cả các mô tả
     * 
     * @return array
     */
    public static function getDescriptions(): array
    {
        return self::$predefinedSettings;
    }

    /**
     * Kiểm tra một cài đặt là hình ảnh/file
     * 
     * @param string $key
     * @return bool
     */
    public static function isImageField(string $key): bool
    {
        return in_array($key, self::$imageFields);
    }

    /**
     * Kiểm tra một cài đặt là email
     * 
     * @param string $key
     * @return bool
     */
    public static function isEmailField(string $key): bool
    {
        return in_array($key, self::$emailFields);
    }

    /**
     * Kiểm tra một cài đặt là điện thoại
     * 
     * @param string $key
     * @return bool
     */
    public static function isPhoneField(string $key): bool
    {
        return in_array($key, self::$phoneFields);
    }

    /**
     * Kiểm tra một cài đặt là URL/Link
     * 
     * @param string $key
     * @return bool
     */
    public static function isUrlField(string $key): bool
    {
        return in_array($key, self::$urlFields);
    }

    /**
     * Kiểm tra một cài đặt là textarea
     * 
     * @param string $key
     * @return bool
     */
    public static function isTextareaField(string $key): bool
    {
        return in_array($key, self::$textareaFields);
    }
}
