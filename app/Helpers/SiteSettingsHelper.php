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
        'site_domain' => 'Tên miền (VD: scf.vn)',
        'site_description' => 'Mô tả ngắn về website (hiển thị ở footer, meta description)',

        // Hình ảnh và logo (upload file)
        'logo' => 'Logo chính (Header - PNG/SVG, nền trong suốt)',
        'sub_logo' => 'Sub Logo/Icon (sử dụng trong các section)',
        'placeholder_image' => 'Ảnh placeholder (hình ảnh mặc định khi không có ảnh)',
        'hero_bg' => 'Hình nền Banner trang chủ (Hero background)',
        'hero_image' => 'Hình ảnh Banner trang chủ (Hero image)',
        'contact_hero_image' => 'Hình ảnh Hero trang Contact',
        'contact_elements_image' => 'Hình ảnh elements trang Contact',

        // Thông tin liên hệ
        'contact_email' => 'Email liên hệ chính (info@company.com)',
        'contact_phone' => 'Số điện thoại chính (Hotline)',
        'office_address' => 'Địa chỉ văn phòng chính',
        'working_hours' => 'Giờ làm việc (VD: 8:00 - 17:30)',
        'google_maps_link' => 'Link Google Maps (URL)',
        'map_embed_src' => 'Link Google Maps Embed (iframe src)',

        // Mạng xã hội
        'facebook_url' => 'Link Facebook Fanpage',
        'youtube_url' => 'Link Youtube Channel',
        'instagram_url' => 'Link Instagram',
        'linkedin_url' => 'Link LinkedIn',

        // Section trang chủ - Hero
        'hero_title' => 'Tiêu đề Hero Banner (trang chủ)',
        'hero_subtitle' => 'Phụ đề Hero Banner',
        'hero_button_text' => 'Text nút Hero (VD: Tìm hiểu thêm)',

        // Section trang chủ - Giới thiệu
        'about_title' => 'Tiêu đề mục Giới thiệu',
        'about_content' => 'Nội dung mục Giới thiệu (văn bản ngắn)',

        // Section trang chủ - Sản phẩm/Dịch vụ
        'service_section_title' => 'Tiêu đề mục Dịch vụ',
        'service_section_subtitle' => 'Phụ đề mục Dịch vụ',

        // Section trang chủ - Tin tức
        'blog_section_title' => 'Tiêu đề mục Tin tức',
        'blog_section_subtitle' => 'Phụ đề mục Tin tức',

        // Footer & Labels
        'footer_copyright' => 'Text bản quyền (Copyright)',
        'contact_button_label' => 'Nhãn nút Liên hệ (VD: Liên hệ ngay)',
        'read_more_label' => 'Text "Đọc thêm" cho bài viết',
    ];

    /**
     * Danh sách các field là hình ảnh/file
     */
    public static array $imageFields = [
        'logo',
        'sub_logo',
        'placeholder_image',
        'hero_bg',
        'hero_image',
        'contact_hero_image',
        'contact_elements_image',
    ];

    /**
     * Danh sách các field là email
     */
    public static array $emailFields = [
        'contact_email',
    ];

    /**
     * Danh sách các field là điện thoại
     */
    public static array $phoneFields = [
        'contact_phone',
    ];

    /**
     * Danh sách các field là URL/Link
     */
    public static array $urlFields = [
        'facebook_url',
        'youtube_url',
        'instagram_url',
        'linkedin_url',
        'google_maps_link',
        'map_embed_src',
    ];

    /**
     * Danh sách các field là textarea (văn bản dài)
     */
    public static array $textareaFields = [
        'site_description',
        'about_content',
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
     * @param string $category ('basic', 'images', 'contact', 'social_media', 'home_sections', 'labels')
     * @return array
     */
    public static function getByCategory(string $category): array
    {
        $settings = [];

        match ($category) {
            'basic' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['site_name', 'site_slogan', 'site_domain', 'site_description']),
                ARRAY_FILTER_USE_KEY),
            'images' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => self::isImageField($key),
                ARRAY_FILTER_USE_KEY),
            'contact' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, [
                    'contact_email', 'contact_phone', 'office_address',
                    'working_hours', 'google_maps_link', 'map_embed_src'
                ]),
                ARRAY_FILTER_USE_KEY),
            'social_media' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, [
                    'facebook_url', 'youtube_url', 'instagram_url', 'linkedin_url'
                ]),
                ARRAY_FILTER_USE_KEY),
            'home_sections' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, [
                    'hero_title', 'hero_subtitle', 'hero_button_text',
                    'about_title', 'about_content',
                    'service_section_title', 'service_section_subtitle',
                    'blog_section_title', 'blog_section_subtitle'
                ]),
                ARRAY_FILTER_USE_KEY),
            'labels' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['contact_button_label', 'read_more_label', 'footer_copyright']),
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
