@php
    // Ensure $siteSettings is available (fallback to DB fetch if layout didn't provide it)
$siteSettings = $siteSettings ?? \App\Models\SiteSetting::pluck('value', 'key')->toArray();

// Fetch 3 most recent published posts as a fallback for the partial
$recentPosts = \App\Models\Post::whereNotNull('published_at')->orderBy('published_at', 'desc')->take(3)->get();
@endphp

<div class="vl-blog-1-area sp7"
    style="background-image: url({{ asset($siteSettings['hero_bg'] ?? 'images/bg1.png') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto">
                <div class="vl-blog-1-section-box heading1 text-center space-margin60">
                    <h5 class="vl-section-subtitle"><span><img
                                src="{{ asset($siteSettings['sub_logo'] ?? 'images/sub-logo2.svg') }}"
                                alt=""></span>{{ $siteSettings['blog_section_title'] ?? 'Tin tức & bài viết' }}
                    </h5>
                    <div class="space24"></div>
                    <h2 class="vl-section-title text-anime-style-3">
                        {{ $siteSettings['blog_section_subtitle'] ?? 'Tin ngành bán buôn & nguồn hàng' }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($recentPosts->isNotEmpty())
                @foreach ($recentPosts as $post)
                    <div class="col-lg-4 col-md-6" data-aos="fade-left" data-aos-duration="900">
                        <div class="vl-blog-1-item">
                            <div class="vl-blog-1-thumb image-anime">
                                <img src="{{ asset_url($post->featured_image ?: $siteSettings['placeholder_image'] ?? 'images/blog-placeholder.png') }}"
                                    alt="{{ $post->title }}">
                            </div>
                            <div class="vl-blog-1-content">
                                <div class="vl-blog-meta">
                                    <ul>
                                        <li><img src="{{ asset('images/date1.svg') }}" alt="">
                                            {{ optional($post->published_at)->format('d M Y') ?? '' }}</li>

                                    </ul>
                                </div>
                                <div class="space14"></div>
                                <h4 class="vl-blog-1-title"><a
                                        href="{{ url('/tin-tuc/' . $post->slug) }}">{{ $post->title }}</a></h4>
                                <div class="space20"></div>
                                <div class="vl-blog-1-icon">
                                    <a href="{{ url('/tin-tuc/' . $post->slug) }}">{{ $siteSettings['read_more_label'] ?? 'Tìm hiểu thêm' }}
                                        <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Fallback to static demo if there are no posts in DB --}}
                @for ($i = 1; $i <= 3; $i++)
                    @php $slug = 'bai-viet-' . $i; @endphp
                    <div class="col-lg-4 col-md-6" data-aos="fade-left" data-aos-duration="900">
                        <div class="vl-blog-1-item">
                            <div class="vl-blog-1-thumb image-anime">
                                <img src="{{ asset('images/blog-img' . $i . '.png') }}" alt="">
                            </div>
                            <div class="vl-blog-1-content">
                                <div class="vl-blog-meta">
                                    <ul>
                                        <li><img src="{{ asset('images/date1.svg') }}" alt=""> 8 December 2024
                                        </li>
                                        <li><img src="{{ asset('images/user1.svg') }}" alt=""> Bởi SCF</li>
                                    </ul>
                                </div>
                                <div class="space14"></div>
                                <h4 class="vl-blog-1-title"><a href="{{ url('/tin-tuc/' . $slug) }}">Bài
                                        {{ $i }}: Xu
                                        hướng mua &
                                        lựa chọn nhà cung cấp</a></h4>
                                <div class="space20"></div>
                                <div class="vl-blog-1-icon">
                                    <a href="{{ url('/tin-tuc/' . $slug) }}">Tìm hiểu thêm <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>
</div>
