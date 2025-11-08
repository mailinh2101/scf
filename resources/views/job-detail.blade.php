@extends('layouts.app')

@section('title', $job->title . ' - Tuyển dụng - SCF')

@section('seo_description', 'Tuyển dụng ' . $job->title . ' tại ' . $job->location . '. ' .
    \Illuminate\Support\Str::limit(strip_tags($job->description), 120))

@section('seo_keywords', $job->title . ', tuyển dụng, ' . $job->location . ', công việc')

@section('canonical', url('/tuyen-dung/' . $job->slug))

@section('og_title', $job->title . ' - Tuyển Dụng')

@section('og_description', 'Vị trí: ' . $job->title . ' | Địa điểm: ' . $job->location . ' | Mức lương: ' .
    ($job->salary_range ?? 'Thương lượng'))

@section('og_url', url('/tuyen-dung/' . $job->slug))

@section('content')
    <!--===== HERO AREA STARTS =======-->
    <div class="inner-section-area"
        style="background-image: url({{ asset($siteSettings['hero_bg'] ?? 'images/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-header-area">
                        <h1>{{ $job->title }}</h1>
                        <div class="space16"></div>
                        <h4>
                            <a href="{{ url('/') }}">Trang chủ</a>
                            <i class="fa-solid fa-angle-right"></i>
                            <a href="{{ route('jobs.index') }}">Tuyển dụng</a>
                            <i class="fa-solid fa-angle-right"></i>
                            <a href="#"><span>{{ $job->title }}</span></a>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="imges-header">
                        <div class="arrow">
                            <a href="#job-content">
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

    <!--===== JOB DETAIL CONTENT STARTS =======-->
    <div id="job-content" class="service3-section-area sp6">
        <div class="container">
            <div class="row">
                <!--===== MAIN CONTENT AREA =======-->
                <div class="col-lg-8">
                    <!--===== JOB DESCRIPTION =======-->
                    <div class="service-branding-boxesarea mb-5" data-aos="fade-up" data-aos-duration="900">
                        <div class="service-brand-head">
                            <h2 style="color: #fff;">Mô tả công việc</h2>
                            <div class="space20"></div>
                            <div style="color: rgba(255,255,255,0.7); line-height: 1.8; font-size: 24px;">
                                {!! nl2br(e($job->description)) !!}
                            </div>
                        </div>
                    </div>

                    <!--===== REQUIREMENTS =======-->
                    @if ($job->requirements)
                        <div class="service-branding-boxesarea mb-5" data-aos="fade-up" data-aos-duration="1000">
                            <div class="service-brand-head">
                                <h2 style="color: #fff;">Yêu cầu công việc</h2>
                                <div class="space20"></div>
                                <div style="color: rgba(255,255,255,0.7); line-height: 1.8; font-size: 24px;">
                                    {!! nl2br(e($job->requirements)) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!--===== BENEFITS =======-->
                    @if ($job->benefits)
                        <div class="service-branding-boxesarea mb-5" data-aos="fade-up" data-aos-duration="1100">
                            <div class="service-brand-head">
                                <h2 style="color: #fff;">Quyền lợi nhân viên</h2>
                                <div class="space20"></div>
                                <div style="color: rgba(255,255,255,0.7); line-height: 1.8; font-size: 24px;">
                                    {!! nl2br(e($job->benefits)) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!--===== APPLY BUTTON =======-->
                    <div class="space50"></div>
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
                </div>

                <!--===== SIDEBAR - JOB DETAILS =======-->
                <div class="col-lg-4">
                    <!--===== JOB OVERVIEW CARD =======-->
                    <div class="service-branding-boxesarea mb-5" data-aos="fade-up" data-aos-duration="900">
                        <div class="service-brand-head">
                            <h2 style="font-size: 28px; margin-bottom: 20px; color: #fff;">Chi tiết công việc</h2>

                            <div
                                style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <h5
                                    style="color: #C0F037; font-size: 20px; text-transform: uppercase; margin-bottom: 8px; font-weight: 600;">
                                    <i class="fa-solid fa-map-pin" style="margin-right: 6px;"></i>Địa điểm
                                </h5>
                                <p style="color: rgba(255,255,255,0.9); font-size: 24px; margin: 0;">{{ $job->location }}
                                </p>
                            </div>

                            <div
                                style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <h5
                                    style="color: #C0F037; font-size: 20px; text-transform: uppercase; margin-bottom: 8px; font-weight: 600;">
                                    <i class="fa-solid fa-clock" style="margin-right: 6px;"></i>Loại hình công việc
                                </h5>
                                <p style="color: rgba(255,255,255,0.9); font-size: 24px; margin: 0;">
                                    {{ $job->employment_type }}</p>
                            </div>

                            <div
                                style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <h5
                                    style="color: #C0F037; font-size: 20px; text-transform: uppercase; margin-bottom: 8px; font-weight: 600;">
                                    <i class="fa-solid fa-money-bill-wave" style="margin-right: 6px;"></i>Mức lương
                                </h5>
                                <p style="color: rgba(255,255,255,0.9); font-size: 24px; margin: 0;">
                                    {{ $job->salary_range ?? 'Thương lượng' }}</p>
                            </div>

                            <div>
                                <h5
                                    style="color: #C0F037; font-size: 20px; text-transform: uppercase; margin-bottom: 8px; font-weight: 600;">
                                    <i class="fa-solid fa-calendar-days" style="margin-right: 6px;"></i>Ngày đăng tuyển
                                </h5>
                                <p style="color: rgba(255,255,255,0.9); font-size: 24px; margin: 0;">
                                    {{ $job->published_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!--===== RECENT JOBS SIDEBAR =======-->
                    @if ($recentJobs->count() > 0)
                        <div class="service-branding-boxesarea mb-5" data-aos="fade-up" data-aos-duration="1000">
                            <div class="service-brand-head">
                                <h2 style="font-size: 28px; margin-bottom: 20px; color: #fff;">Những vị trí khác</h2>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    @foreach ($recentJobs as $recentJob)
                                        <li style="border-bottom: 1px solid rgba(255,255,255,0.1); padding: 16px 0;">
                                            <a href="{{ route('jobs.show', $recentJob->slug) }}"
                                                style="color: #C0F037; font-weight: 600; text-decoration: none; transition: color 0.3s;">
                                                {{ $recentJob->title }}
                                            </a>
                                            <p style="color: rgba(255,255,255,0.6); font-size: 13px; margin: 6px 0 0 0;">
                                                <i class="fa-solid fa-map-pin"
                                                    style="margin-right: 4px;"></i>{{ $recentJob->location }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!--===== CONTACT INFO SIDEBAR =======-->
                    <div class="service-branding-boxesarea" data-aos="fade-up" data-aos-duration="1100">
                        <div class="service-brand-head">
                            <h2 style="font-size: 28px; margin-bottom: 20px; color: #fff;">Liên hệ</h2>

                            @if ($job->contact_email)
                                <div style="margin-bottom: 16px;">
                                    <h5
                                        style="color: #C0F037; font-size: 20px; text-transform: uppercase; margin-bottom: 8px; font-weight: 600;">
                                        Email
                                    </h5>
                                    <a href="mailto:{{ $job->contact_email }}"
                                        style="color: #fff; text-decoration: none; word-break: break-all;">
                                        {{ $job->contact_email }}
                                    </a>
                                </div>
                            @endif

                            <div>
                                <h5
                                    style="color: #C0F037; font-size: 20px; text-transform: uppercase; margin-bottom: 8px; font-weight: 600;">
                                    Công ty
                                </h5>
                                <p style="color: #fff; margin: 0;">{{ config('app.name', 'SCF') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== JOB DETAIL CONTENT ENDS =======-->

    <!--===== APPLICATION FORM SECTION STARTS =======-->
    <div id="apply-form" class="contact-author-boxarea sp6">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="heading1 space-margin60 text-center mb-5">
                        <h5 style="color: #fff;"><img
                                src="{{ asset($siteSettings['sub_logo'] ?? 'images/sub-logo2.svg') }}" alt="">
                            Nộp đơn ứng tuyển</h5>
                        <div class="space20"></div>
                        <h2 style="color: #fff;">Bước đầu tiên để gia nhập đội ngũ của chúng tôi</h2>
                    </div>

                    <form method="post" action="{{ route('job.application.submit') }}" enctype="multipart/form-data"
                        data-ajax-submit="true"
                        style="background: rgba(255,255,255,0.02); padding: 40px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                        @csrf
                        <input type="hidden" name="position" value="{{ $job->title }}">

                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="input-area">
                                    <label style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">
                                        Họ và tên <span style="color: #C0F037;">*</span>
                                    </label>
                                    <input type="text" name="name" placeholder="Nhập họ và tên" required
                                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; border-radius: 4px; width: 100%; font-size: 14px;">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="input-area">
                                    <label style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">
                                        Email <span style="color: #C0F037;">*</span>
                                    </label>
                                    <input type="email" name="email" placeholder="your@email.com" required
                                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; border-radius: 4px; width: 100%; font-size: 14px;">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="input-area">
                                    <label style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">
                                        Số điện thoại
                                    </label>
                                    <input type="text" name="phone" placeholder="0123456789"
                                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; border-radius: 4px; width: 100%; font-size: 14px;">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="input-area">
                                    <label style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">
                                        Vị trí ứng tuyển
                                    </label>
                                    <input type="text" value="{{ $job->title }}" disabled
                                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #999; padding: 12px 16px; border-radius: 4px; width: 100%; font-size: 14px; cursor: not-allowed;">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-4">
                                <div class="input-area">
                                    <label style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">
                                        Thư xin việc (tối đa 500 ký tự)
                                    </label>
                                    <textarea name="message" placeholder="Viết vài dòng về bản thân bạn..." rows="5"
                                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; border-radius: 4px; width: 100%; font-size: 14px; resize: vertical;"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12 mb-4">
                                <div class="input-area">
                                    <label style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">
                                        CV (PDF) <span style="color: #C0F037;">*</span>
                                    </label>
                                    <input type="file" name="cv" accept="application/pdf" required
                                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; border-radius: 4px; width: 100%; font-size: 14px;">
                                    <small style="color: rgba(255,255,255,0.6); display: block; margin-top: 8px;">
                                        <i class="fa-solid fa-circle-check" style="margin-right: 4px;"></i>Chỉ chấp nhận
                                        file PDF, dung lượng tối đa 5MB
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="input-area text-center">
                                    <button type="submit" class="vl-btn1">
                                        <span><i class="fa-solid fa-paper-plane"></i></span> Gửi hồ sơ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--===== APPLICATION FORM SECTION ENDS =======-->

    <!--===== RELATED JOBS SECTION STARTS =======-->
    @if ($recentJobs->count() > 1)
        <div class="service3-section-area sp6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto mb-5">
                        <div class="heading1 text-center">
                            <h5><img src="{{ asset($siteSettings['sub_logo'] ?? 'images/sub-logo2.svg') }}"
                                    alt=""> Cơ hội khác</h5>
                            <div class="space20"></div>
                            <h2 class="text-anime-style-3" style="color: #fff;">Các vị trí tuyển dụng khác</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($recentJobs->take(3) as $otherJob)
                        <div class="col-lg-4 mb-4" data-aos="fade-up"
                            data-aos-duration="{{ 900 + $loop->index * 100 }}">
                            <div class="service-branding-boxesarea">
                                <div class="service-brand-head">
                                    <h2>
                                        <a href="{{ route('jobs.show', $otherJob->slug) }}"
                                            style="color: #fff; text-decoration: none;">
                                            {{ $otherJob->title }}
                                        </a>
                                    </h2>
                                    <div class="space12"></div>
                                    <ul class="service-list">
                                        <li style="color: rgba(255,255,255,0.8);"><i class="fa-solid fa-map-pin"
                                                style="margin-right: 6px;"></i>{{ $otherJob->location }}</li>
                                        <li style="color: rgba(255,255,255,0.8);"><i class="fa-solid fa-clock"
                                                style="margin-right: 6px;"></i>{{ $otherJob->employment_type }}</li>
                                        @if ($otherJob->salary_range)
                                            <li style="color: rgba(255,255,255,0.8);"><i
                                                    class="fa-solid fa-money-bill-wave"
                                                    style="margin-right: 6px;"></i>{{ $otherJob->salary_range }}</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="hidden-img">
                                    <i class="fa-solid fa-briefcase" style="font-size: 48px; color: #C0F037;"></i>
                                </div>
                                <div class="arrow">
                                    <a href="{{ route('jobs.show', $otherJob->slug) }}">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!--===== RELATED JOBS SECTION ENDS =======-->

    <!--===== BACK TO JOBS CTA STARTS =======-->
    <div class="cta-btn-area sp6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-area text-center">
                        <a href="{{ route('jobs.index') }}" class="cta-btn1"
                            style="background-color: transparent; border: 2px solid #C0F037; color: #C0F037; display: inline-block; padding: 14px 32px; border-radius: 4px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách tuyển dụng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== BACK TO JOBS CTA ENDS =======-->

@endsection
