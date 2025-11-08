@extends('layouts.app')

@section('title', 'Liên hệ - SCF')

@section('seo_description', 'Liên hệ với SCF để được tư vấn, hỗ trợ sản phẩm. Chúng tôi luôn sẵn sàng giúp bạn.')

@section('seo_keywords', 'liên hệ, hỗ trợ, tư vấn, SCF')

@section('og_title', 'Liên Hệ - SCF')

@section('og_description', 'Liên hệ với SCF để được tư vấn, hỗ trợ sản phẩm.')

@section('content')

    <!-- ===== CONTACT HERO ===== -->
    <div class="inner-section-area"
        style="background-image: url('{{ asset('images/hero-bg1.png') }}'); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-header-area">
                        <h1>Liên hệ</h1>
                        <div class="space32"></div>
                        <h4><a href="{{ url('/') }}">Trang chủ</a> <i class="fa-solid fa-angle-right"></i> <span><a
                                    href="{{ url('/lien-he') }}">Liên hệ</a></span></h4>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                    <div class="imges-header">
                        <div class="img1">
                            <img src="{{ asset_url($siteSettings['contact_hero_image'] ?? 'images/hero-img1.png') }}" alt="" class="keyframe6">
                        </div>
                        <div class="arrow">
                            <a href="#contact-form">
                                <img src="{{ asset('images/arrow1.svg') }}" alt="" class="arrow1">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space30"></div>
        </div>
    </div>

    <!-- ===== CONTACT AREA ===== -->
    <div class="contact-inner-area sp6">
        <img src="{{ asset($siteSettings['hero_image'] ?? 'images/elements15.png') }}" alt="" class="elements15">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="heading1 text-center">
                        <h5><span><img src="{{ asset($siteSettings['sub_logo'] ?? 'images/sub-logo2.svg') }}"
                                    alt=""></span>Bạn cần trợ giúp? Hãy
                            liên hệ!</h5>
                        <div class="space20"></div>
                        <h2>Liên hệ với {{ $siteSettings['site_domain'] ?? 'SCF' }}</h2>
                    </div>

                    <div class="space40"></div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="widget-contactbox">
                                <div class="icons">
                                    <img src="{{ asset('images/mail2.svg') }}" alt="">
                                </div>
                                <div class="content">
                                    <h4>Email</h4>
                                    <a
                                        href="mailto:{{ $siteSettings['contact_email'] ?? 'info@example.com' }}">{{ $siteSettings['contact_email'] ?? 'info@example.com' }}</a>
                                </div>
                            </div>
                            <div class="space30 d-lg-none d-block"></div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="widget-contactbox">
                                <div class="icons">
                                    <img src="{{ asset('images/phn2.svg') }}" alt="">
                                </div>
                                <div class="content">
                                    <h4>Điện thoại</h4>
                                    <a
                                        href="tel:{{ $siteSettings['contact_phone'] ?? '+84901234567' }}">{{ $siteSettings['contact_phone'] ?? '+84 90 123 4567' }}</a>
                                </div>
                            </div>
                            <div class="space30 d-lg-none d-block"></div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="widget-contactbox">
                                <div class="icons">
                                    <img src="{{ asset('images/clock2.svg') }}" alt="">
                                </div>
                                <div class="content">
                                    <h4>Giờ làm việc</h4>
                                    <a href="#">{{ $siteSettings['working_hours'] ?? 'T2–T7: 8:30 – 18:00' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="space60"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-images">
                                <img src="{{ asset($siteSettings['contact_elements_image'] ?? 'images/elements21.webp') }}" alt="" class="elements21">
                                <div class="img1">
                                    <img src="{{ asset_url($siteSettings['contact_image_1'] ?? 'images/contact-img1.png') }}" alt="">
                                </div>
                                <div class="img2">
                                    <img src="{{ asset_url($siteSettings['contact_image_2'] ?? 'images/contact-img2.png') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div id="contact-form" class="contact-author-boxarea">
                                <h3>Gửi yêu cầu</h3>
                                <div class="space8"></div>
                                <form method="post" action="{{ route('contact.submit') }}" data-ajax-submit="true">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-area">
                                                <input type="text" name="first_name" placeholder="Họ và tên*"
                                                    value="{{ old('first_name') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-area">
                                                <input type="email" name="email" placeholder="Email*"
                                                    value="{{ old('email') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-area">
                                                <input type="text" name="phone" placeholder="Số điện thoại"
                                                    value="{{ old('phone') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-area">
                                                <input type="text" name="subject" placeholder="Tiêu đề"
                                                    value="{{ old('subject') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="input-area">
                                                <textarea name="message" placeholder="Nội dung liên hệ" required>{{ old('message') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="space32"></div>
                                            <div class="input-area text-end">
                                                <button type="submit" class="vl-btn1"
                                                    style="overflow: hidden;">Gửi</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="space60"></div>
                    <div class="maps-area">
                        <iframe
                            src="{{ $siteSettings['map_embed_src'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.570673417451!2d106.70703337455609!3d10.844130589308751!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175299b1aef1dcb%3A0x7e01192379cc648f!2sBSI%20Tower!5e0!3m2!1svi!2s!4v1762325777176!5m2!1svi!2s' }}"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
