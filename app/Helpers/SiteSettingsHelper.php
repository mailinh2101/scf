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
        'site_name' => 'Tên website',
        'site_domain' => 'Tên miền (VD: starvik.vn)',
        'site_description' => 'Mô tả ngắn về website (hiển thị ở footer)',
        
        // Hình ảnh và logo (upload file)
        'logo' => 'Logo chính (hình ảnh PNG/SVG)',
        'sub_logo' => 'Logo phụ (hình ảnh PNG/SVG)',
        'placeholder_image' => 'Ảnh placeholder (hình ảnh mặc định)',
        'hero_bg' => 'Hình nền trang chủ (hình ảnh nền)',
        'hero_image' => 'Ảnh trang Sản phẩm (hình ảnh minh họa)',
        
        // Thông tin liên hệ
        'contact_email' => 'Email liên hệ (VD: hello@starvik.vn)',
        'contact_phone' => 'Số điện thoại liên hệ (VD: +84 90 123 4567)',
        'office_address' => 'Địa chỉ văn phòng (VD: Hà Nội, Việt Nam)',
        'contact_button_label' => 'Nhãn nút Liên hệ (VD: Liên hệ ngay)',
        
        // Section Tin tức
        'blog_section_title' => 'Tiêu đề section Tin tức (VD: Tin tức & bài viết)',
        'blog_section_subtitle' => 'Phụ đề section Tin tức (VD: Tin ngành bán buôn & nguồn hàng)',
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
     * @param string $category ('basic', 'images', 'contact', 'blog')
     * @return array
     */
    public static function getByCategory(string $category): array
    {
        $settings = [];
        
        match ($category) {
            'basic' => $settings = array_filter(self::$predefinedSettings, 
                fn($key) => in_array($key, ['site_name', 'site_domain', 'site_description']), 
                ARRAY_FILTER_USE_KEY),
            'images' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['logo', 'sub_logo', 'placeholder_image', 'hero_bg', 'hero_image']),
                ARRAY_FILTER_USE_KEY),
            'contact' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['contact_email', 'contact_phone', 'office_address', 'contact_button_label']),
                ARRAY_FILTER_USE_KEY),
            'blog' => $settings = array_filter(self::$predefinedSettings,
                fn($key) => in_array($key, ['blog_section_title', 'blog_section_subtitle']),
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
}
