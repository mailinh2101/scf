@extends('layouts.app')

@section('title', $post->seo_title ?: $post->title . ' - SCF')

@section('seo_description', $post->seo_description ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160))

@section('seo_keywords', 'blog, tin tức, bài viết, ' . $post->title)

@section('canonical', url('/tin-tuc/' . $post->slug))

@section('og_type', 'article')

@section('og_title', $post->seo_title ?: $post->title)

@section('og_description', $post->seo_description ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160))

@section('og_image', asset_url($post->featured_image ?: 'images/placeholder.svg'))

@section('og_url', url('/tin-tuc/' . $post->slug))

@section('content')

    <!-- ===== BLOG POST HERO ===== -->
    <div class="inner-section-area"
        style="background-image: url({{ asset('images/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-header-area">
                        <h1>{{ $post->title }}</h1>
                        <div class="space32"></div>
                        <h4><a href="{{ url('/tin-tuc') }}">Tin tức</a> <i class="fa-solid fa-angle-right"></i> <span><a
                                    href="#">{{ $post->title }}</a></span></h4>
                    </div>
                </div>
            </div>
            <div class="space30"></div>
        </div>
    </div>

    <!--===== BLOG AREA STARTS =======-->
    <div class="blog-details-section-area sp9">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-others-sidebar">
                        <div class="img1">
                            <img src="{{ asset_url($post->featured_image ?: 'images/placeholder.svg') }}"
                                alt="{{ $post->title }}">
                        </div>
                        <div class="space32"></div>
                        <ul class="list-author">
                            <li><a href="#">{{ $post->category ?? 'Blog' }}</a></li>
                            <li><a href="#"><img src="{{ asset('images/date1.svg') }}" alt="">
                                    {{ optional($post->published_at)->format('d M Y') ?? 'Chưa xác định' }} <span> |
                                    </span></a></li>
                            <li><a href="#"><img src="{{ asset('images/user1.svg') }}" alt="">
                                    {{ $post->author_name ?? 'SCF' }}</a></li>
                        </ul>
                        <div class="space24"></div>
                        <h2>{{ $post->title }}</h2>
                        <div class="space20"></div>
                        <div class="post-content">
                            {!! $post->content !!}
                        </div>
                        <div class="space40"></div>
                        <div class="tags-social">
                            <div class="tags">
                                <ul>
                                    <li>Tags:</li>
                                    <li><a href="#">#Blog</a></li>
                                    <li><a href="#" class="m-0">#SCF</a></li>
                                </ul>
                            </div>
                            <div class="social">
                                <ul>
                                    <li>Social:</li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#" class="m-0"><i class="fa-brands fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-details-side">
                        <div class="search-area">
                            <h3>Tìm kiếm</h3>
                            <div class="space24"></div>
                            <form>
                                <input type="text" placeholder="Tìm kiếm...">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <div class="space30"></div>
                        <div class="recent-posts">
                            <h3>Bài viết gần đây</h3>
                            <div class="space32"></div>
                            @forelse($recentPosts as $recentPost)
                                <div class="img1">
                                    <img src="{{ asset_url($recentPost->featured_image ?: 'images/placeholder.svg') }}"
                                        alt="{{ $recentPost->title }}">
                                </div>
                                <div class="space24"></div>
                                <div class="content-area">
                                    <ul>
                                        <li><a href="#"><img src="{{ asset('images/date1.svg') }}"
                                                    alt="">{{ optional($recentPost->published_at)->format('d M Y') ?? 'Chưa xác định' }}</a>
                                        </li>
                                    </ul>
                                    <div class="space14"></div>
                                    <a href="{{ url('/tin-tuc/' . $recentPost->slug) }}">{{ $recentPost->title }}</a>
                                    <div class="space20"></div>
                                    <a href="{{ url('/tin-tuc/' . $recentPost->slug) }}" class="readmore">Đọc thêm <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                                <div class="space30"></div>
                            @empty
                                <p>Không có bài viết nào</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== BLOG AREA ENDS =======-->


@endsection
