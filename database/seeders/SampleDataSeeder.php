<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Job;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // Sample Products
        $products = [
            [
                'title' => 'Bộ nồi chảo gia đình cao cấp',
                'slug' => 'bo-noi-chao-gia-dinh-cao-cap-' . time(),
                'description' => 'Bộ nồi chảo 5 chi tiết được làm từ thép không gỉ cao cấp, an toàn với sức khỏe gia đình. Đáy dày, truyền nhiệt đều.',
                'image' => 'products/cookware-set.jpg',
                'category' => 'do-gia-dung',
                'published' => true,
                'seo_title' => 'Nồi chảo cao cấp cho gia đình',
                'seo_description' => 'Bộ nồi chảo thép không gỉ an toàn, bền bỉ, phù hợp cho nấu ăn hàng ngày.',
            ],
            [
                'title' => 'Nước rửa chén sinh học an toàn',
                'slug' => 'nuoc-rua-chen-sinh-hoc-an-toan-' . time(),
                'description' => 'Nước rửa chén từ nguyên liệu thiên nhiên, không chứa hóa chất độc hại, hiệu quả diệt khuẩn 99.9%.',
                'image' => 'products/dishwasher-liquid.jpg',
                'category' => 'do-gia-dung',
                'published' => true,
                'seo_title' => 'Nước rửa chén sinh học an toàn cho gia đình',
                'seo_description' => 'Sản phẩm rửa chén không độc hại, an toàn cho sức khỏe và môi trường.',
            ],
            [
                'title' => 'Máy massage cầm tay thư giãn cơ bắp',
                'slug' => 'may-massage-cam-tay-thu-gian-co-bap-' . time(),
                'description' => 'Thiết bị massage điện tử với nhiều chế độ rung, giúp thư giãn cơ bắp, giảm mệt mỏi sau công việc.',
                'image' => 'products/massage-gun.jpg',
                'category' => 'do-gia-dung',
                'published' => true,
                'seo_title' => 'Máy massage thư giãn cơ bắp hiệu quả',
                'seo_description' => 'Massage gun chất lượng cao, an toàn, mang lại sự thoải mái và thư giãn.',
            ],
            [
                'title' => 'Thực phẩm chức năng tăng cường miễn dịch',
                'slug' => 'thuc-pham-chuc-nang-tang-cuong-mien-dich-' . time(),
                'description' => 'Viên uống bổ sung vitamin, khoáng chất, giúp tăng cường miễn dịch, phòng chống cảm cúm và bệnh viêm.',
                'image' => 'products/immune-boost.jpg',
                'category' => 'thuc-pham-chuc-nang',
                'published' => true,
                'seo_title' => 'Viên uống tăng cường miễn dịch',
                'seo_description' => 'Thực phẩm chức năng giúp tăng sức đề kháng cho cơ thể.',
            ],
            [
                'title' => 'Bộ vệ sinh nhà bếp 6 chi tiết',
                'slug' => 'bo-ve-sinh-nha-bep-6-chi-tiet-' . time(),
                'description' => 'Bộ dụng cụ lau dọn nhà bếp hoàn chỉnh gồm mút rửa, khăn lau, xà bông, v.v.',
                'image' => 'products/kitchen-cleaning-kit.jpg',
                'category' => 'do-gia-dung',
                'published' => true,
                'seo_title' => 'Bộ vệ sinh nhà bếp đầy đủ',
                'seo_description' => 'Dụng cụ lau dọn nhà bếp hiệu quả, giá cả phải chăng.',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Sample Posts / Blog Articles
        $posts = [
            [
                'title' => 'Cách chọn nồi chảo phù hợp cho nấu ăn hàng ngày',
                'excerpt' => 'Hướng dẫn chi tiết cách lựa chọn nồi chảo phù hợp với nhu cầu nấu ăn của gia đình.',
                'content' => '<p>Chọn nồi chảo là một quyết định quan trọng cho nhà bếp của bạn. Nồi chảo tốt không chỉ giúp nấu ăn ngon hơn mà còn kéo dài tuổi thọ.</p><p><strong>Những tiêu chí cần xem xét:</strong></p><ul><li>Chất liệu: thép không gỉ, nhôm, đá vô địch</li><li>Độ dày đáy nồi</li><li>Tay cầm và nắp nồi</li><li>Khả năng truyền nhiệt</li></ul><p>Hãy chọn nồi chảo từ các thương hiệu uy tín để đảm bảo chất lượng lâu dài.</p>',
                'featured_image' => 'blog/choosing-cookware.jpg',
                'published_at' => now()->subDays(5),
                'seo_title' => 'Hướng dẫn chọn nồi chảo tốt cho nấu ăn',
                'seo_description' => 'Tìm hiểu cách lựa chọn nồi chảo phù hợp với nhu cầu của gia đình bạn.',
            ],
            [
                'title' => '5 mẹo vệ sinh nhà bếp hiệu quả và nhanh chóng',
                'excerpt' => 'Những mẹo nhỏ giúp bạn vệ sinh nhà bếp sạch sẽ trong thời gian ngắn nhất.',
                'content' => '<p>Nhà bếp sạch sẽ là nền tảng của một gia đình khỏe mạnh. Dưới đây là 5 mẹo vệ sinh hiệu quả:</p><ol><li>Rửa chén ngay sau khi ăn xong</li><li>Lau bề mặt tủ bếp thường xuyên</li><li>Vệ sinh mặt bếp hàng ngày</li><li>Dọn rác đúng cách</li><li>Sử dụng nước rửa chén sinh học an toàn</li></ol><p>Thực hiện những mẹo này sẽ giúp nhà bếp của bạn luôn sạch sẽ và an toàn.</p>',
                'featured_image' => 'blog/kitchen-cleaning-tips.jpg',
                'published_at' => now()->subDays(10),
                'seo_title' => '5 mẹo vệ sinh nhà bếp hiệu quả',
                'seo_description' => 'Tìm hiểu những mẹo vệ sinh nhà bếp nhanh chóng và hiệu quả.',
            ],
            [
                'title' => 'Lợi ích của thực phẩm chức năng đối với sức khỏe',
                'excerpt' => 'Tìm hiểu về những lợi ích của thực phẩm chức năng và cách sử dụng đúng cách.',
                'content' => '<p>Thực phẩm chức năng ngày càng trở nên phổ biến trong cuộc sống hiện đại. Nhưng bạn có hiểu rõ về lợi ích của chúng không?</p><p><strong>Những lợi ích chính:</strong></p><ul><li>Bổ sung dưỡng chất thiếu hụt</li><li>Tăng cường miễn dịch</li><li>Cải thiện sức khỏe tiêu hóa</li><li>Hỗ trợ sức khỏe xương khớp</li></ul><p>Hãy lựa chọn thực phẩm chức năng từ các nguồn uy tín và tuân thủ hướng dẫn sử dụng.</p>',
                'featured_image' => 'blog/functional-food-benefits.jpg',
                'published_at' => now()->subDays(15),
                'seo_title' => 'Lợi ích thực phẩm chức năng cho sức khỏe',
                'seo_description' => 'Khám phá những lợi ích của thực phẩm chức năng và cách sử dụng hiệu quả.',
            ],
        ];

        foreach ($posts as $post) {
            Post::firstOrCreate(['title' => $post['title']], $post);
        }

        // Sample Jobs
        $jobs = [
            [
                'title' => 'Nhân viên Kinh doanh Online',
                'position' => 'Nhân viên Kinh doanh',
                'description' => 'Chúng tôi đang tìm kiếm nhân viên kinh doanh online có năng lực để phát triển thị trường và chăm sóc khách hàng.

Nhiệm vụ chính:
- Tư vấn và giới thiệu sản phẩm đến khách hàng qua các kênh online
- Phát triển và duy trì mối quan hệ với khách hàng
- Đạt chỉ tiêu doanh số theo tháng/quý
- Báo cáo kết quả công việc định kỳ',
                'location' => 'Hồ Chí Minh',
                'employment_type' => 'full-time',
                'salary_range' => '8-15 triệu',
                'requirements' => '• Tốt nghiệp Đại học/Cao đẳng
• Có kinh nghiệm bán hàng online từ 1 năm trở lên
• Thành thạo tin học văn phòng và các công cụ bán hàng online
• Kỹ năng giao tiếp tốt, chủ động, nhiệt tình
• Có tinh thần trách nhiệm cao',
                'benefits' => '• Mức lương cạnh tranh + hoa hồng hấp dẫn
• Bảo hiểm theo quy định
• Đào tạo chuyên môn
• Cơ hội thăng tiến
• Môi trường làm việc thân thiện',
                'published' => true,
                'published_at' => now()->subDays(3),
                'contact_email' => 'hr@scf.vn',
            ],
            [
                'title' => 'Nhân viên Hỗ trợ Khách hàng',
                'position' => 'Nhân viên CSKH',
                'description' => 'Đội ngũ chăm sóc khách hàng là bộ mặt của công ty. Chúng tôi cần những nhân viên tận tâm, chu đáo để mang đến trải nghiệm tốt nhất cho khách hàng.

Nhiệm vụ chính:
- Tư vấn sản phẩm và giải đáp thắc mắc của khách hàng
- Xử lý đơn hàng và theo dõi giao nhận
- Giải quyết khiếu nại và góp ý của khách hàng
- Ghi nhận và báo cáo phản hồi khách hàng',
                'location' => 'Hồ Chí Minh',
                'employment_type' => 'full-time',
                'salary_range' => '7-12 triệu',
                'requirements' => '• Tốt nghiệp Trung cấp trở lên
• Có kinh nghiệm chăm sóc khách hàng từ 6 tháng
• Giọng nói rõ ràng, dễ nghe
• Thái độ phục vụ tốt, kiên nhẫn
• Thành thạo tin học văn phòng',
                'benefits' => '• Lương tháng 13 + thưởng hiệu suất
• Bảo hiểm đầy đủ
• Đào tạo nghiệp vụ
• Phụ cấp ăn uống, điện thoại
• Môi trường làm việc chuyên nghiệp',
                'published' => true,
                'published_at' => now()->subDays(7),
                'contact_email' => 'hr@scf.vn',
            ],
            [
                'title' => 'Nhân viên Kho & Vận chuyển (Remote)',
                'position' => 'Nhân viên Kho',
                'description' => 'Chúng tôi đang mở rộng kho hàng và cần nhân viên quản lý kho chuyên nghiệp.

Nhiệm vụ chính:
- Quản lý tồn kho, nhập xuất hàng hóa
- Kiểm tra chất lượng sản phẩm
- Đóng gói và chuẩn bị đơn hàng
- Phối hợp với bộ phận giao nhận
- Báo cáo tồn kho định kỳ',
                'location' => 'Remote',
                'employment_type' => 'full-time',
                'salary_range' => '6-10 triệu',
                'requirements' => '• Không yêu cầu bằng cấp
• Có kinh nghiệm quản lý kho từ 1 năm
• Cẩn thận, tỉ mỉ trong công việc
• Có sức khỏe tốt
• Thành thạo Excel cơ bản',
                'benefits' => '• Lương ổn định + thưởng
• Bảo hiểm y tế
• Đồng phục công ty
• Phụ cấp xăng xe
• Làm việc gần nhà',
                'published' => true,
                'published_at' => now()->subDays(10),
                'contact_email' => 'hr@scf.vn',
            ],
        ];

        foreach ($jobs as $job) {
            \App\Models\Job::firstOrCreate(['title' => $job['title']], $job);
        }

        // Site Settings - Tất cả cài đặt được quản lý qua database (không sửa code)
        // Hướng dẫn: Vào Filament > Settings để chỉnh sửa bất kỳ giá trị nào
        $settings = [
            // ══════════════════════════════════════════════════════════════
            // 📋 CHUNG - GLOBAL SETTINGS (áp dụng cho toàn bộ website)
            // ══════════════════════════════════════════════════════════════
            ['key' => 'site_domain', 'value' => 'scf.vn'],
            ['key' => 'site_description', 'value' => 'SCF — Cung cấp sản phẩm gia dụng chất lượng cao và thực phẩm chức năng an toàn cho gia đình Việt.'],

            // ══════════════════════════════════════════════════════════════
            // 🎨 LOGO & BIỂU TƯỢNG (dùng chung trên tất cả các trang)
            // ══════════════════════════════════════════════════════════════
            ['key' => 'logo_header', 'value' => 'images/logo.png'],
            ['key' => 'logo_footer', 'value' => 'images/logo2.png'],
            ['key' => 'sub_logo', 'value' => 'images/sub-logo2.svg'],
            ['key' => 'placeholder_image', 'value' => 'images/placeholder.svg'],

            // ══════════════════════════════════════════════════════════════
            // 📞 LIÊN HỆ - CONTACT PAGE (trang liên hệ)
            // ══════════════════════════════════════════════════════════════
            // Thông tin liên hệ hiển thị trên trang Contact & Footer
            ['key' => 'contact_email', 'value' => 'hr03.gr@gmail.com'],
            ['key' => 'contact_phone', 'value' => '0902.381.851'],
            ['key' => 'contact_address', 'value' => 'Lầu 6, 195-197 Nguyễn Thị Nhung, Hiệp Bình Phước, Thủ Đức, Hồ Chí Minh, Việt Nam'],
            ['key' => 'contact_working_hours', 'value' => 'Thứ 2 - Thứ 7: 8:00 - 17:00'],
            ['key' => 'contact_map_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.570673417451!2d106.70703337455609!3d10.844130589308751!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175299b1aef1dcb%3A0x7e01192379cc648f!2sBSI%20Tower!5e0!3m2!1svi!2s!4v1762325777176!5m2!1svi!2s'],

            // Hình ảnh trang Contact
            ['key' => 'contact_hero_image', 'value' => 'images/hero-img1.png'],
            ['key' => 'contact_hero_decoration', 'value' => 'images/elements21.webp'],
            ['key' => 'contact_section_image_left', 'value' => 'images/contact-img1.png'],
            ['key' => 'contact_section_image_right', 'value' => 'images/contact-img2.png'],

            // ══════════════════════════════════════════════════════════════
            // 📰 TIN TỨC - BLOG PAGE (trang blog/tin tức)
            // ══════════════════════════════════════════════════════════════
            // Tiêu đề & mô tả hiển thị trên danh sách bài viết
            ['key' => 'blog_section_title', 'value' => 'Tin tức & bài viết'],
            ['key' => 'blog_section_subtitle', 'value' => 'Tin ngành bán buôn & nguồn hàng'],

            // Hình ảnh trang Blog
            ['key' => 'blog_hero_image', 'value' => 'images/hero-img1.png'],
            ['key' => 'blog_hero_decoration', 'value' => 'images/elements15.png'],

            // ══════════════════════════════════════════════════════════════
            // 💼 TUYỂN DỤNG - CAREERS PAGE (trang tuyển dụng/việc làm)
            // ══════════════════════════════════════════════════════════════
            // Hình ảnh trang Careers
            ['key' => 'careers_hero_image', 'value' => 'images/hero-img1.png'],
            ['key' => 'careers_hero_decoration', 'value' => 'images/elements15.png'],

            // ══════════════════════════════════════════════════════════════
            // 🛍️ SẢN PHẨM - PRODUCTS PAGE (trang sản phẩm)
            // ══════════════════════════════════════════════════════════════
            // Hình ảnh trang Products
            ['key' => 'products_hero_image', 'value' => 'images/hero-img1.png'],
            ['key' => 'products_hero_decoration', 'value' => 'images/elements15.png'],

            // ══════════════════════════════════════════════════════════════
            // ℹ️ GIỚI THIỆU - ABOUT PAGE (trang giới thiệu công ty)
            // ══════════════════════════════════════════════════════════════
            // Hình ảnh trang About
            ['key' => 'about_hero_image', 'value' => 'images/hero-img1.png'],
            ['key' => 'about_hero_decoration', 'value' => 'images/elements15.png'],

            // ══════════════════════════════════════════════════════════════
            // 🏠 TRANG CHỦ - HOME PAGE (trang đầu tiên khi vào website)
            // ══════════════════════════════════════════════════════════════
            // Hình ảnh trang Home
            ['key' => 'home_hero_background', 'value' => 'images/bg1.png'],
            ['key' => 'home_hero_image', 'value' => 'images/elements15.png'],
            ['key' => 'home_hero_decoration', 'value' => 'images/elements15.png'],

            // ══════════════════════════════════════════════════════════════
            // 🦶 FOOTER - Dùng chung cho tất cả các trang
            // ══════════════════════════════════════════════════════════════
            ['key' => 'footer_decoration_image', 'value' => 'images/elements6.png'],

            // ══════════════════════════════════════════════════════════════
            // 🏷️ NỘI DUNG VĂN BẢN - LABELS (các nhãn/nút trên website)
            // ══════════════════════════════════════════════════════════════
            ['key' => 'button_contact_label', 'value' => 'Liên hệ'],
            ['key' => 'button_read_more_label', 'value' => 'Tìm hiểu thêm'],
            ['key' => 'button_learn_more_label', 'value' => 'Đọc thêm'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
