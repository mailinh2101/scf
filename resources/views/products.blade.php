@extends('layouts.app')

@section('title', 'Sản phẩm - SCF')

@section('seo_description',
    'Khám phá bộ sưu tập sản phẩm gia dụng chất lượng cao và thực phẩm chức năng an toàn từ
    SCF.')

@section('seo_keywords', 'sản phẩm, gia dụng, thực phẩm chức năng, mua online, chất lượng')

@section('og_title', 'Danh Sách Sản Phẩm - SCF')

@section('og_description',
    'Khám phá bộ sưu tập sản phẩm gia dụng chất lượng cao và thực phẩm chức năng an toàn từ
    SCF.')

@section('content')

    <!-- ===== PRODUCTS HERO ===== -->
    @php
        $heroBg = $siteSettings['hero_bg'] ?? null;
        $heroImg = $siteSettings['hero_image'] ?? null;
    @endphp
    <div class="inner-section-area"
        style="background-image: url({{ asset($heroBg ?: 'images/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-header-area">
                        <h1>Sản phẩm</h1>
                        <div class="space32"></div>
                        <h4><a href="{{ url('/') }}">Trang chủ</a> <i class="fa-solid fa-angle-right"></i> <span><a
                                    href="#">Danh
                                    sách sản phẩm</a></span></h4>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="imges-header">
                        <div class="img1">
                            <img src="{{ asset($heroImg ?: 'images/hero-img1.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="space30"></div>
        </div>
    </div>

    <!-- ===== PRODUCT GRID ===== -->
    <div class="project-inner-section-area sp6"
        style="background-image: url({{ asset('images/bg5.webp') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="tabs-area text-center space-margin60">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Tất cả</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Gia dụng</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Thực phẩm chức năng</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        {{-- Tab: Tất cả sản phẩm --}}
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="all-project-area">
                                <div class="row">
                                    @forelse($products as $product)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="portfolio-boxarea">
                                                <div class="img1">
                                                    <img src="{{ asset_url($product->image ?: 'images/placeholder.svg') }}"
                                                        alt="{{ $product->title }}">
                                                </div>
                                                <div class="arrow-content">
                                                    <div class="arrow">
                                                        <a href="#"><span><i
                                                                    class="fa-solid fa-arrow-right"></i></span></a>
                                                    </div>
                                                    <div class="content-area">
                                                        @php
                                                            $categoryLabel = match ($product->category) {
                                                                'thuc-pham-chuc_nang' => 'Thực phẩm chức năng',
                                                                'thuc-pham-chuc-nang' => 'Thực phẩm chức năng',
                                                                'do-gia-dung' => 'Gia dụng',
                                                                default => 'Sản phẩm',
                                                            };
                                                        @endphp
                                                        <p class="product-type">{{ $categoryLabel }}</p>
                                                        <div class="space16"></div>
                                                        <a href="#" class="product-title">{{ $product->title }}</a>
                                                        <p class="product-excerpt">
                                                            {{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 120) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-12">
                                            <p class="text-center">Chưa có sản phẩm nào được công bố.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Tab: Gia dụng --}}
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                            tabindex="0">
                            <div class="all-project-area">
                                <div class="row">
                                    @php
                                        $giadungProducts = $products->filter(function ($product) {
                                            return $product->category === 'do-gia-dung';
                                        });
                                    @endphp
                                    @forelse($giadungProducts as $product)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="portfolio-boxarea">
                                                <div class="img1">
                                                    <img src="{{ asset_url($product->image ?: 'images/placeholder.svg') }}"
                                                        alt="{{ $product->title }}">
                                                </div>
                                                <div class="arrow-content">
                                                    <div class="arrow">
                                                        <a href="#"><span><i
                                                                    class="fa-solid fa-arrow-right"></i></span></a>
                                                    </div>
                                                    <div class="content-area">
                                                        <p class="product-type">Gia dụng</p>
                                                        <div class="space16"></div>
                                                        <a href="#" class="product-title">{{ $product->title }}</a>
                                                        <p class="product-excerpt">
                                                            {{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 120) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-12">
                                            <p class="text-center">Chưa có sản phẩm gia dụng nào.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Tab: Thực phẩm chức năng --}}
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab" tabindex="0">
                            <div class="all-project-area">
                                <div class="row">
                                    @php
                                        $nutritionProducts = $products->filter(function ($product) {
                                            return in_array($product->category, [
                                                'thuc-pham-chuc_nang',
                                                'thuc-pham-chuc-nang',
                                            ]);
                                        });
                                    @endphp
                                    @forelse($nutritionProducts as $product)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="portfolio-boxarea">
                                                <div class="img1">
                                                    <img src="{{ asset_url($product->image ?: 'images/placeholder.svg') }}"
                                                        alt="{{ $product->title }}">
                                                </div>
                                                <div class="arrow-content">
                                                    <div class="arrow">
                                                        <a href="#"><span><i
                                                                    class="fa-solid fa-arrow-right"></i></span></a>
                                                    </div>
                                                    <div class="content-area">
                                                        <p class="product-type">Thực phẩm chức năng</p>
                                                        <div class="space16"></div>
                                                        <a href="#" class="product-title">{{ $product->title }}</a>
                                                        <p class="product-excerpt">
                                                            {{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 120) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-12">
                                            <p class="text-center">Chưa có sản phẩm thực phẩm chức năng nào.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{ $products->links() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>

@endsection
