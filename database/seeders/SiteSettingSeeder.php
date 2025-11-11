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
            [
                'key' => 'site_keywords',
                'value' => 'phân phối buôn, gia dụng, thực phẩm chức năng, SCF, bán buôn',
            ],

            // Contact Email
            [
                'key' => 'contact_email',
                'value' => 'info@scf.vn',
            ],
            [
                'key' => 'contact_email_sales',
                'value' => 'sales@scf.vn',
            ],
            [
                'key' => 'contact_email_support',
                'value' => 'support@scf.vn',
            ],

            // Contact Phone
            [
                'key' => 'contact_phone',
                'value' => '+84 90 123 4567',
            ],
            [
                'key' => 'contact_phone_office',
                'value' => '+84 24 1234 5678',
            ],
            [
                'key' => 'zalo_number',
                'value' => '0901234567',
            ],
            [
                'key' => 'whatsapp_number',
                'value' => '84901234567',
            ],

            // Address
            [
                'key' => 'office_address',
                'value' => 'Số 123 Đường ABC, Quận XYZ, Hà Nội, Việt Nam',
            ],
            [
                'key' => 'google_maps_link',
                'value' => 'https://maps.google.com',
            ],

            // Working Hours
            [
                'key' => 'working_hours',
                'value' => '8:00 - 17:30',
            ],
            [
                'key' => 'working_days',
                'value' => 'Thứ 2 - Thứ 6',
            ],
            [
                'key' => 'working_hours_saturday',
                'value' => '8:00 - 12:00',
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

            // Hero Section
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
            [
                'key' => 'hero_button_link',
                'value' => '/san-pham',
            ],

            // About Section
            [
                'key' => 'about_title',
                'value' => 'Về chúng tôi',
            ],
            [
                'key' => 'about_subtitle',
                'value' => 'Đối tác tin cậy của bạn',
            ],
            [
                'key' => 'about_content',
                'value' => 'SCF là đơn vị phân phối hàng đầu với nhiều năm kinh nghiệm trong lĩnh vực cung cấp các mặt hàng gia dụng và thực phẩm chức năng. Chúng tôi cam kết mang đến cho khách hàng những sản phẩm chất lượng với giá cả cạnh tranh nhất.',
            ],

            // Product Section
            [
                'key' => 'product_section_title',
                'value' => 'Sản phẩm của chúng tôi',
            ],
            [
                'key' => 'product_section_subtitle',
                'value' => 'Khám phá các sản phẩm chất lượng',
            ],

            // Service Section
            [
                'key' => 'service_section_title',
                'value' => 'Dịch vụ của chúng tôi',
            ],
            [
                'key' => 'service_section_subtitle',
                'value' => 'Giải pháp toàn diện cho doanh nghiệp',
            ],

            // Blog Section
            [
                'key' => 'blog_section_title',
                'value' => 'Tin tức & Blog',
            ],
            [
                'key' => 'blog_section_subtitle',
                'value' => 'Cập nhật tin tức mới nhất',
            ],

            // Partner Section
            [
                'key' => 'partner_section_title',
                'value' => 'Đối tác của chúng tôi',
            ],
            [
                'key' => 'partner_section_subtitle',
                'value' => 'Những đối tác tin cậy',
            ],

            // Footer
            [
                'key' => 'footer_about_text',
                'value' => 'SCF là đơn vị phân phối uy tín với nhiều năm kinh nghiệm. Chúng tôi luôn đặt chất lượng sản phẩm và sự hài lòng của khách hàng lên hàng đầu.',
            ],
            [
                'key' => 'footer_copyright',
                'value' => '© Copyright 2024 - SCF. All Rights Reserved',
            ],

            // Contact CTA
            [
                'key' => 'contact_button_label',
                'value' => 'Liên hệ ngay',
            ],
            [
                'key' => 'contact_cta_title',
                'value' => 'Sẵn sàng hợp tác?',
            ],
            [
                'key' => 'contact_cta_subtitle',
                'value' => 'Liên hệ với chúng tôi để được tư vấn chi tiết',
            ],

            // Business Info
            [
                'key' => 'company_legal_name',
                'value' => 'Công ty TNHH SCF Việt Nam',
            ],
            [
                'key' => 'tax_code',
                'value' => '0123456789',
            ],
            [
                'key' => 'business_license',
                'value' => '0123456789',
            ],
            [
                'key' => 'founding_year',
                'value' => '2020',
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
    }
}
