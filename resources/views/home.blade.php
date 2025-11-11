@extends('layouts.app')

@section('title', 'Trang chủ - SCF')

@section('seo_description',
    'Công Ty TNHH SCF cung cấp sản phẩm gia dụng chất lượng cao và thực phẩm chức năng an toàn
    cho gia đình Việt.')

@section('seo_keywords', 'scf, sản phẩm gia dụng, thực phẩm chức năng, gia đình, mua sắm online')

@section('og_title', 'SCF - Sản Phẩm Gia Dụng & Thực Phẩm Chức Năng Chất Lượng')

@section('og_description',
    'Công Ty TNHH SCF cung cấp sản phẩm gia dụng chất lượng cao và thực phẩm chức năng an toàn
    cho gia đình Việt.')

@section('content')
    <!--===== HERO AREA STARTS =======-->
    <div class="hero1-section-area"
        style="background-image: url({{ asset($siteSettings['hero_bg'] ?? 'images/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10">
                    <div class="hero-header-area">
                        <h6 class="text-anime-style-3">{{ $siteSettings['site_slogan'] ?? 'Welcome to SCF' }}</h6>

                        <h1 class="text-anime-style-3">
                            {{ $siteSettings['hero_title'] ?? 'Công Ty TNHH SCF' }}
                        </h1>

                        <div class="space32"></div>

                        <h5 class="text-anime-style-3">{{ $siteSettings['hero_subtitle'] ?? 'Được thành lập vào năm 2020, Công ty TNHH SCF hoạt động kinh doanh trong lĩnh vực chăm sóc sức khỏe, sắc đẹp và đồ gia dụng. Với đội ngũ nhiệt huyết, năng động không ngại khó khăn thử thách dần khẳng định vị thế của mình trên thị trường.' }}
                        </h5>
                        <div class="space40 d-md-block d-none"></div>
                        <div class="space16 d-block d-md-none"></div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <img src="{{ asset('images/elements1.png') }}" alt="" class="elements1 keyframe5">
                </div>
            </div>
            <div class="col-lg-10">
                <img src="{{ asset('images/team.webp') }}" alt="T">
            </div>
            <div class="space60"></div>
        </div>
    </div>
    <!--===== HERO AREA ENDS =======-->

    <!--===== ABOUT AREA STARTS =======-->
    <div class="about1-section-area sp6">
        <img src="{{ asset('images/elements9.png') }}" alt="" class="elements9">
        <div class="space60"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="images">
                        <div class="img1 reveal">
                            <img src="{{ asset('images/may-massage.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-header heading1">
                        <h2 class="text-anime-style-3">{{ $siteSettings['about_title'] ?? 'Sản phẩm gia dụng & thực phẩm chức năng dành cho người tiêu dùng' }}</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-left" data-aos-duration="900">{{ $siteSettings['about_content'] ?? 'SCF cung cấp các sản phẩm gia dụng và thực phẩm chức năng thân thiện với người tiêu dùng, đảm bảo chất lượng, an toàn và dịch vụ giao hàng nhanh chóng.' }}</p>
                        <div class="space32"></div>
                        <div class="btn-area1" data-aos="fade-left" data-aos-duration="1100">
                            <a href="{{ url('/san-pham') }}" class="vl-btn1" style="overflow: hidden;">{{ $siteSettings['hero_button_text'] ?? 'Xem sản phẩm' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== ABOUT AREA ENDS =======-->

    <!--===== SERVICE AREA STARTS =======-->
    <div class="service1-section-area sp6"
        style="background-image: url({{ asset('images/bg3.png') }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="service-header heading1 text-center space-margin60">
                        <h5><img src="{{ asset('images/sub-logo2.svg') }}" alt=""> {{ $siteSettings['service_section_subtitle'] ?? 'Dịch vụ khách hàng' }}</h5>
                        <div class="space20"></div>
                        <h2 class="text-anime-style-3">{{ $siteSettings['service_section_title'] ?? 'Dịch vụ & lợi ích cho khách hàng' }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="900">
                            <div class="service-branding-boxesarea">
                                <div class="service-brand-head">
                                    <h2><a href="#">Sản phẩm đa dạng</a></h2>
                                    <div class="space8"></div>
                                    <ul class="service-list">
                                        <li><a href="#">#Gia dụng chất lượng</a></li>
                                        <li><a href="#">#Thực phẩm sạch</a></li>
                                    </ul>
                                </div>
                                <div class="arrow">
                                    <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1000">
                            <div class="service-branding-boxesarea">
                                <div class="service-brand-head">
                                    <h2><a href="#">Giao hàng tận nhà</a></h2>
                                    <div class="space8"></div>
                                    <ul class="service-list">
                                        <li><a href="#">#Giao hàng nhanh</a></li>
                                        <li><a href="#">#Theo dõi đơn hàng</a></li>
                                    </ul>
                                </div>
                                <div class="arrow">
                                    <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1100">
                            <div class="service-branding-boxesarea">
                                <div class="service-brand-head">
                                    <h2><a href="#">Chính sách đổi trả</a></h2>
                                    <div class="space8"></div>
                                    <ul class="service-list">
                                        <li><a href="#">#Đổi trả miễn phí</a></li>
                                        <li><a href="#">#Hoàn tiền 100%</a></li>
                                    </ul>
                                </div>
                                <div class="arrow">
                                    <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200">
                            <div class="service-branding-boxesarea">
                                <div class="service-brand-head">
                                    <h2><a href="#">Hỗ trợ khách hàng</a></h2>
                                    <div class="space8"></div>
                                    <ul class="service-list">
                                        <li><a href="#">#Chat trực tuyến</a></li>
                                        <li><a href="#">#Hỗ trợ 24/7</a></li>
                                    </ul>
                                </div>
                                <div class="arrow">
                                    <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== SERVICE AREA ENDS =======-->

    @include('partials.marquee')
    <div class="space32"></div>

    @include('partials.counter')
    <div class="space32"></div>

    @include('partials.testimonials')

    @include('partials.blog')

    @include('partials.cta')
@endsection
