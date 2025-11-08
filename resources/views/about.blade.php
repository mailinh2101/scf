@extends('layouts.app')

@section('title', 'Giới thiệu - SCF')

@section('seo_description', 'Tìm hiểu về SCF - Công Ty TNHH SCF, doanh nghiệp hàng đầu trong lĩnh vực sản phẩm gia dụng
    và thực phẩm chức năng.')

@section('seo_keywords', 'giới thiệu, SCF, công ty, về chúng tôi')

@section('og_title', 'Giới Thiệu SCF - Doanh Nghiệp Uy Tín')

@section('og_description', 'Tìm hiểu về SCF - Công Ty TNHH SCF, doanh nghiệp hàng đầu trong lĩnh vực sản phẩm gia dụng
    và thực phẩm chức năng.')

@section('content')

    <!-- ===== ABOUT PAGE HERO ===== -->
    <div class="hero1-section-area"
        style="background-image: url({{ asset('images/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-header-area">
                        <h5><img src="{{ asset('images/sub-logo1.svg') }}" alt=""> Giới thiệu</h5>
                        <div class="space32"></div>
                        <h1 class="text-anime-style-3">Về SCF — Sự lựa chọn cho
                            cuộc sống tiện nghi</h1>
                        <div class="space16"></div>
                        <p style="font-size: 18px; color: rgba(255,255,255,0.8); line-height: 1.6;">SCF chuyên cung cấp
                            các sản phẩm gia dụng thiết yếu và thực phẩm chức năng chất lượng, phục
                            vụ nhu cầu hàng ngày của gia đình Việt. Chúng tôi cam kết mang đến sản phẩm an toàn, dịch vụ tận
                            tâm và giao hàng nhanh chóng.</p>
                        <div class="space32"></div>
                        <div class="btn-area1">
                            <a href="{{ url('/san-pham') }}" class="vl-btn1">Xem sản phẩm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="imges-header">
                        <img src="{{ asset('images/about-img1.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== COMPANY MISSION / VISION ===== -->
    <div class="about1-section-area sp6">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 style="font-size: 24px; color: #fff; margin-bottom: 20px;">Nhiệm vụ của chúng tôi</h3>
                    <p style="font-size: 18px; color: rgba(255,255,255,0.8); line-height: 1.6; margin-bottom: 20px;">Đem đến
                        những sản phẩm gia dụng và thực phẩm chức năng an toàn, tiện lợi và phù hợp với nhu cầu của
                        người tiêu dùng. Chúng tôi lựa chọn nhà cung cấp nghiêm ngặt và kiểm soát chất lượng trước khi đưa
                        sản phẩm tới tay khách hàng.</p>
                    <div class="space20"></div>
                    <h3 style="font-size: 24px; color: #fff; margin-bottom: 20px;">Tầm nhìn</h3>
                    <p style="font-size: 18px; color: rgba(255,255,255,0.8); line-height: 1.6; margin-bottom: 20px;">Trở
                        thành điểm tới tin cậy của người tiêu dùng khi tìm mua các giải pháp gia dụng và sản phẩm chăm
                        sóc sức khỏe tại Việt Nam.</p>
                </div>
                <div class="col-lg-6">
                    <h3 style="font-size: 24px; color: #fff; margin-bottom: 20px;">Giá trị cốt lõi</h3>
                    <ul class="list-unstyled" style="font-size: 18px;">
                        <li style="color: rgba(255,255,255,0.8); margin-bottom: 12px;"><strong style="color: #fff;">Chất
                                lượng:</strong> Sản phẩm được kiểm định kỹ lưỡng.</li>
                        <li style="color: rgba(255,255,255,0.8); margin-bottom: 12px;"><strong style="color: #fff;">Uy
                                tín:</strong> Minh bạch nguồn gốc và mô tả sản phẩm.</li>
                        <li style="color: rgba(255,255,255,0.8); margin-bottom: 12px;"><strong style="color: #fff;">Khách
                                hàng:</strong> Dịch vụ hỗ trợ tận tâm, chính sách đổi trả rõ ràng.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== CTA ===== -->
    <div class="service1-section-area sp6"
        style="background-image: url({{ asset('images/bg3.png') }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="container text-center">
            <h2 style="font-size: 32px; color: #fff; margin-bottom: 20px;">Muốn biết thêm?</h2>
            <p style="font-size: 18px; color: rgba(255,255,255,0.8); margin-bottom: 30px;">Liên hệ với chúng tôi để được tư
                vấn sản phẩm phù hợp cho gia đình bạn.</p>
            <a href="{{ url('/lien-he') }}" class="vl-btn1">Liên hệ</a>
        </div>
    </div>

@endsection
