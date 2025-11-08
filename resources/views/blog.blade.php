@extends('layouts.app')

@section('title', 'Tin tức - SCF')

@section('seo_description',
    'Đọc các bài viết và tin tức mới nhất về sản phẩm gia dụng, thực phẩm chức năng và lối sống
    lành mạnh.')

@section('seo_keywords', 'tin tức, blog, bài viết, sức khỏe, gia dụng, thực phẩm chức năng')

@section('og_title', 'Tin Tức & Bài Viết - SCF')

@section('og_description',
    'Đọc các bài viết và tin tức mới nhất về sản phẩm gia dụng, thực phẩm chức năng và lối sống
    lành mạnh.')

@section('content')
    <!--===== HERO AREA STARTS =======-->
    <div class="inner-section-area"
        style="background-image: url({{ asset('images/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        @php
            $heroBg = $siteSettings['hero_bg'] ?? null;
            $heroImg = $siteSettings['hero_image'] ?? null;
        @endphp
        <div class="inner-section-area"
            style="background-image: url({{ asset('images/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-header-area">
                            <h1>Tin tức</h1>
                            <div class="space32"></div>
                            <h4><a href="index.html">Trang chủ</a> <i class="fa-solid fa-angle-right"></i> <a
                                    href="#">Tin tức</a></h4>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="space30"></div>
            </div>
        </div>

        <!--===== BLOG AREA STARTS =======-->
        <div class="vl-blog-1-area sp7"
            style="background-image: url({{ asset('images/bg5.webp') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
            <img src="{{ asset('images/elements15.png') }}" alt="" class="elements15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="vl-blog-1-section-box heading1 text-center space-margin60">
                            <h2>Tin tức mới nhất</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse($posts as $post)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900">
                            <div class="vl-blog-1-item">
                                <div class="vl-blog-1-thumb image-anime">
                                    <img src="{{ asset_url($post->featured_image ?: 'images/placeholder.svg') }}"
                                        alt="{{ $post->title }}">
                                </div>
                                <div class="vl-blog-1-content">
                                    <div class="vl-blog-meta">
                                        <ul>
                                            <li><img src="{{ asset('images/date1.svg') }}" alt="">
                                                <a
                                                    href="#">{{ optional($post->published_at)->format('d M Y') ?? '' }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space14"></div>
                                    <h4 class="vl-blog-1-title"><a
                                            href="{{ url('/tin-tuc/' . $post->slug) }}">{{ $post->title }}</a></h4>
                                    <div class="space20"></div>
                                    <div class="vl-blog-1-icon">
                                        <a href="{{ url('/tin-tuc/' . $post->slug) }}">Đọc tiếp <i
                                                class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12">
                            <p class="text-center">Chưa có bài viết nào được xuất bản.</p>
                        </div>
                    @endforelse
                </div>

                {{ $posts->links() }}

            </div>
        </div>
        <!--===== BLOG AREA ENDS =======-->


    @endsection
