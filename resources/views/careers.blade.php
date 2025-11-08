@extends('layouts.app')

@section('title', 'Tuyển dụng - SCF')

@section('seo_description', 'Tìm cơ hội việc làm tại SCF. Gia nhập đội ngũ trẻ trung, nhiệt huyết của chúng tôi.')

@section('seo_keywords', 'tuyển dụng, việc làm, công việc, SCF, nhân viên')

@section('og_title', 'Tuyển Dụng - Cơ Hội Việc Làm Tại SCF')

@section('og_description', 'Tìm cơ hội việc làm tại SCF. Gia nhập đội ngũ trẻ trung, nhiệt huyết của chúng tôi.')

@section('content')
    <!--===== HERO AREA STARTS =======-->
    <div class="inner-section-area"
        style="background-image: url({{ asset($siteSettings['hero_bg'] ?? 'images/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-header-area">
                        <h1>Tuyển dụng</h1>
                        <div class="space32"></div>
                        <h4><a href="{{ url('/') }}">Trang chủ</a> <i class="fa-solid fa-angle-right"></i> <span><a
                                    href="#">Cơ hội nghề nghiệp</a></span></h4>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                    <div class="imges-header">
                        <div class="img1">
                            <img src="{{ asset('images/hero-img1.png') }}" alt="" class="keyframe6">
                        </div>
                        <div class="arrow">
                            <a href="#job-listings">
                                <img src="{{ asset('images/elements2.png') }}" alt="" class="keyframe5">
                                <img src="{{ asset('images/arrow1.svg') }}" alt="" class="arrow1">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space30"></div>
        </div>
    </div>
    <!--===== HERO AREA ENDS =======-->

    <!--===== MARQUEE SLIDER 1 STARTS =======-->
    @if ($jobs->count() > 0)
        <div class="slider1-section-area">
            <div class="marquee-wrap">
                <div class="marquee-text">
                    @forelse ($jobs as $job)
                        <div class="brand-single-box">
                            <h3>{{ $job->title }} - {{ $job->location }} <img src="{{ asset('images/elements5.png') }}"
                                    alt=""></h3>
                        </div>
                    @empty
                        <div class="brand-single-box">
                            <h3>Không có vị trí tuyển dụng nào</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
    <!--===== MARQUEE SLIDER 1 ENDS =======-->

    <!--===== JOB LISTINGS AREA STARTS =======-->
    <div id="job-listings" class="serve-section-area sp9">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="heading1 space-margin60 text-center">
                        <h5 style="color: #fff;"><img src="{{ asset($siteSettings['sub_logo'] ?? 'images/sub-logo2.svg') }}"
                                alt=""> Gia nhập SCF</h5>
                        <div class="space20"></div>
                        <h2 style="color: #fff;">Các vị trí đang tuyển</h2>
                    </div>
                </div>
            </div>

            @if ($jobs->count() > 0)
                <div class="slider2-section-area">
                    <div class="marquee-wrap">
                        <div class="marquee-text">
                            @foreach ($jobs as $job)
                                <div class="brand-single-box">
                                    <h3><a href="{{ route('jobs.show', $job->slug) }}" class="apply-link"
                                            data-position="{{ $job->title }}">
                                            <span><i class="fa-solid fa-arrow-right"></i></span>{{ $job->title }} -
                                            {{ $job->location }}
                                        </a></h3>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    <div class="alert alert-info">
                        <p style="color: #fff; margin: 0;">Hiện tại không có vị trí tuyển dụng nào. Vui lòng quay lại sau!
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!--===== JOB LISTINGS AREA ENDS =======-->

    <!--===== JOB DETAIL BOXES AREA STARTS =======-->
    @if ($jobs->count() > 0)
        <div class="service3-section-area sp6">
            <img src="{{ asset($siteSettings['hero_image'] ?? 'images/elements15.png') }}" alt=""
                class="elements15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @forelse ($jobs as $job)
                            <div id="job-{{ $job->slug }}" class="service-branding-boxesarea" data-aos="fade-up"
                                data-aos-duration="{{ 900 + $loop->index * 100 }}">
                                <div class="service-brand-head">
                                    <h2><a href="{{ route('jobs.show', $job->slug) }}"
                                            style="color: #fff; text-decoration: none;">{{ $job->title }}</a></h2>
                                    <div class="space8"></div>
                                    <ul class="service-list">
                                        <li><a href="#">📍 {{ $job->location }}</a></li>
                                        <li><a href="#">⏰ {{ $job->employment_type }}</a></li>
                                        @if ($job->salary_range)
                                            <li><a href="#">💰 {{ $job->salary_range }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="hidden-img">
                                    <i class="fa-solid fa-briefcase" style="font-size: 48px; color: #C0F037;"></i>
                                </div>
                                <div class="arrow">
                                    <a href="{{ route('jobs.show', $job->slug) }}"><i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <p style="color: #fff; margin: 0;">Hiện tại không có vị trí tuyển dụng nào. Vui lòng quay
                                    lại sau!</p>
                            </div>
                        @endforelse

                        <div class="space100"></div>

                        <div class="started-btn" data-aos="zoom-in" data-aos-duration="1000">
                            <svg xmlns="http://www.w3.org/2000/svg" width="190" height="190" viewBox="0 0 190 190"
                                fill="none" class="keyframe5">
                                <path
                                    d="M89.6307 2.22405C92.2799 1.12669 93.6046 0.578013 95 0.578013C96.3954 0.578013 97.7201 1.12669 100.369 2.22405L156.806 25.6008C159.455 26.6982 160.78 27.2468 161.766 28.2336C162.753 29.2203 163.302 30.5449 164.399 33.1942L187.776 89.6307C188.873 92.2799 189.422 93.6046 189.422 95C189.422 96.3954 188.873 97.7201 187.776 100.369L164.399 156.806C163.302 159.455 162.753 160.78 161.766 161.766C160.78 162.753 159.455 163.302 156.806 164.399L100.369 187.776C97.7201 188.873 96.3954 189.422 95 189.422C93.6046 189.422 92.2799 188.873 89.6307 187.776L33.1942 164.399C30.5449 163.302 29.2203 162.753 28.2336 161.766C27.2468 160.78 26.6982 159.455 25.6008 156.806L2.22405 100.369C1.12669 97.7201 0.578013 96.3954 0.578013 95C0.578013 93.6046 1.12669 92.2799 2.22405 89.6307L25.6008 33.1942C26.6982 30.5449 27.2468 29.2203 28.2336 28.2336C29.2203 27.2468 30.5449 26.6982 33.1942 25.6008L89.6307 2.22405Z"
                                    fill="#C0F037" />
                            </svg>
                            <a href="#apply-form"><span><i class="fa-solid fa-arrow-right"></i></span></a>
                            <div class="space10"></div>
                            <a href="#apply-form">Nộp đơn ngay</a>
                        </div>

                        <div class="space50"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--===== JOB DETAIL BOXES AREA ENDS =======-->

    <!--===== MARQUEE SLIDER 2 STARTS =======-->
    @if ($jobs->count() > 0)
        <div class="slider1-section-area">
            <div class="marquee-wrap">
                <div class="marquee-text">
                    @foreach ($jobs as $job)
                        <div class="brand-single-box">
                            <h3>{{ $job->title }} - {{ $job->location }} <img
                                    src="{{ asset('images/elements5.png') }}" alt=""></h3>
                        </div>
                    @endforeach
                    @foreach ($jobs as $job)
                        <div class="brand-single-box">
                            <h3>{{ $job->title }} - {{ $job->location }} <img
                                    src="{{ asset('images/elements5.png') }}" alt=""></h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!--===== MARQUEE SLIDER 2 ENDS =======-->

@endsection
