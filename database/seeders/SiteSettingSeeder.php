<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Thông tin cơ bản
            [
                'key' => 'site_name',
                'value' => 'SCF',
            ],
            [
                'key' => 'site_slogan',
                'value' => 'Nhà phân phối uy tín hàng đầu',
            ],
            [
                'key' => 'site_domain',
                'value' => 'scf.vn',
            ],
            [
                'key' => 'site_description',
                'value' => 'SCF — Nhà phân phối bán buôn các mặt hàng gia dụng và thực phẩm chức năng, cam kết chất lượng và giao hàng đúng hẹn.',
            ],

            // Contact Info
            [
                'key' => 'contact_email',
                'value' => 'info@scf.vn',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+84 90 123 4567',
            ],
            [
                'key' => 'office_address',
                'value' => 'Số 123 Đường ABC, Quận XYZ, Hà Nội, Việt Nam',
            ],
            [
                'key' => 'working_hours',
                'value' => '8:00 - 17:30, Thứ 2 - Thứ 6',
            ],
            [
                'key' => 'google_maps_link',
                'value' => 'https://maps.google.com',
            ],
            [
                'key' => 'map_embed_src',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.570673417451!2d106.70703337455609!3d10.844130589308751!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175299b1aef1dcb%3A0x7e01192379cc648f!2sBSI%20Tower!5e0!3m2!1svi!2s!4v1762325777176!5m2!1svi!2s',
            ],

            // Social Media
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/scfvn',
            ],
            [
                'key' => 'youtube_url',
                'value' => 'https://youtube.com/@scfvn',
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/scfvn',
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/scfvn',
            ],

            // Hero Section (Home)
            [
                'key' => 'hero_title',
                'value' => 'Nhà Phân Phối Uy Tín Hàng Đầu',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Chuyên cung cấp các mặt hàng gia dụng và thực phẩm chức năng chất lượng cao',
            ],
            [
                'key' => 'hero_button_text',
                'value' => 'Khám phá ngay',
            ],

            // About Section (Home)
            [
                'key' => 'about_title',
                'value' => 'Sản phẩm gia dụng & thực phẩm chức năng dành cho người tiêu dùng',
            ],
            [
                'key' => 'about_content',
                'value' => 'SCF là đơn vị phân phối hàng đầu với nhiều năm kinh nghiệm trong lĩnh vực cung cấp các mặt hàng gia dụng và thực phẩm chức năng. Chúng tôi cam kết mang đến cho khách hàng những sản phẩm chất lượng với giá cả cạnh tranh nhất.',
            ],

            // Service Section (Home)
            [
                'key' => 'service_section_title',
                'value' => 'Dịch vụ & lợi ích cho khách hàng',
            ],
            [
                'key' => 'service_section_subtitle',
                'value' => 'Dịch vụ khách hàng',
            ],

            // Blog Section
            [
                'key' => 'blog_section_title',
                'value' => 'Tin tức & bài viết',
            ],
            [
                'key' => 'blog_section_subtitle',
                'value' => 'Tin ngành bán buôn & nguồn hàng',
            ],

            // Labels & Footer
            [
                'key' => 'footer_copyright',
                'value' => '© Copyright 2024 - SCF. All Rights Reserved',
            ],
            [
                'key' => 'contact_button_label',
                'value' => 'Liên hệ',
            ],
            [
                'key' => 'read_more_label',
                'value' => 'Tìm hiểu thêm',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }

        $this->command->info('✅ Site settings seeded successfully!');
        $this->command->info('📊 Total settings: ' . count($settings));
        $this->command->info('🔑 Keys được sử dụng trong dự án: ' . implode(', ', array_column($settings, 'key')));
    }
}
