<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <meta name="description" content="@yield('seo_description', $siteSettings['site_description'] ?? 'SCF - Cung cấp sản phẩm gia dụng chất lượng cao và thực phẩm chức năng an toàn.')">
    <meta name="keywords" content="@yield('seo_keywords', 'sản phẩm gia dụng, thực phẩm chức năng, scf')">
    <meta name="author" content="{{ $siteSettings['site_domain'] ?? 'SCF' }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#C0F037">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical', request()->url())">

    {{-- Open Graph Meta Tags (Social Media) --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', config('app.name', 'SCF') . ' - ' . (request()->is('/') ? 'Trang chủ' : \Illuminate\Support\Str::title(request()->segment(1))))">
    <meta property="og:description" content="@yield('og_description', $siteSettings['site_description'] ?? 'Cung cấp sản phẩm gia dụng chất lượng cao và thực phẩm chức năng an toàn cho gia đình Việt.')">
    <meta property="og:image" content="@yield('og_image', asset($siteSettings['logo'] ?? 'images/logo.png'))">
    <meta property="og:url" content="@yield('og_url', request()->url())">
    <meta property="og:site_name" content="{{ config('app.name', 'SCF') }}">
    <meta property="og:locale" content="vi_VN">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', config('app.name', 'SCF'))">
    <meta name="twitter:description" content="@yield('twitter_description', $siteSettings['site_description'] ?? 'Sản phẩm gia dụng và thực phẩm chức năng chất lượng.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset($siteSettings['logo'] ?? 'images/logo.png'))">

    {{-- Additional SEO --}}
    <meta name="language" content="Vietnamese">
    <meta name="revisit-after" content="7 days">
    <meta name="distribution" content="global">

    <title>@yield('title', config('app.name', 'SCF') . ' - Trang chủ')</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}" type="image/x-icon">

    {{-- Styles (from original template) --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owlcarousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">


    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ config('app.name', 'SCF') }}",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset($siteSettings['logo'] ?? 'images/logo.png') }}",
        "description": "{{ $siteSettings['site_description'] ?? 'Cung cấp sản phẩm gia dụng chất lượng cao và thực phẩm chức năng an toàn.' }}",
        "contact": {
            "@type": "ContactPoint",
            "telephone": "{{ $siteSettings['contact_phone'] ?? '+84 90 123 4567' }}",
            "contactType": "Customer Support",
            "email": "{{ $siteSettings['contact_email'] ?? 'info@scf.vn' }}"
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ $siteSettings['office_address'] ?? '195 Nguyễn Thị Nhung' }}",
            "addressCountry": "VN"
        },
        "sameAs": [
            "https://www.facebook.com",
            "https://www.instagram.com",
            "https://www.youtube.com"
        ]
    }
    </script>

    @stack('head')
    <script src="{{ asset('js/jquery-3-7-1.min.js') }}"></script>
</head>

<body class="body-bg1">

    @include('partials.preloader')

    @include('partials.header')

    @include('partials.offcanvas')

    <div id="app">
        @yield('content')
    </div>

    @include('partials.footer')

    {{-- Scripts (from original template) --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/counter.js') }}"></script>
    <script src="{{ asset('js/gsap.min.js') }}"></script>
    <script src="{{ asset('js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('js/Splitetext.js') }}"></script>
    <script src="{{ asset('js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/magnific-popup.js') }}"></script>
    <script src="{{ asset('js/mobilemenu.js') }}"></script>
    <script src="{{ asset('js/owlcarousel.min.js') }}"></script>
    <script src="{{ asset('js/nice-select.js') }}"></script>
    <script src="{{ asset('js/waypoints.js') }}"></script>
    <script src="{{ asset('js/slick-slider.js') }}"></script>
    <script src="{{ asset('js/circle-progress.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')

    {{-- SweetAlert2 Notifications --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show success alert if redirected with success message
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#28a745',
                    timer: 4000,
                    timerProgressBar: true,
                });
            @endif

            // Show error alert if redirected with error message
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#dc3545',
                });
            @endif
        });

        // Handle form submissions with AJAX
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form[data-ajax-submit="true"]');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.textContent;

                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang gửi...';

                    fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]')?.content || formData.get(
                                    '_token'),
                            },
                            body: formData,
                        })
                        .then(response => {
                            // Handle both JSON and non-JSON responses
                            const contentType = response.headers.get('content-type');
                            if (contentType && contentType.includes('application/json')) {
                                return response.json().then(data => ({
                                    ok: response.ok,
                                    data: data
                                }));
                            } else {
                                return response.text().then(text => ({
                                    ok: response.ok,
                                    data: {
                                        success: response.ok,
                                        message: 'Success'
                                    }
                                }));
                            }
                        })
                        .then(({
                            ok,
                            data
                        }) => {
                            if (ok && data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thành công!',
                                    text: data.message || 'Form được gửi thành công.',
                                    confirmButtonText: 'Đóng',
                                    confirmButtonColor: '#28a745',
                                    timer: 3000,
                                    timerProgressBar: true,
                                }).then(() => {
                                    if (data.redirect) {
                                        window.location.href = data.redirect;
                                    } else {
                                        form.reset();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: data.message || 'Có lỗi xảy ra.',
                                    confirmButtonText: 'Đóng',
                                    confirmButtonColor: '#dc3545',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Có lỗi xảy ra khi gửi form. Vui lòng thử lại sau.',
                                confirmButtonText: 'Đóng',
                                confirmButtonColor: '#dc3545',
                            });
                        })
                        .finally(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnText;
                        });
                });
            });
        });
    </script>
    <script>
        // Replace broken images with a small SVG placeholder to avoid 404 icons
        document.addEventListener('DOMContentLoaded', function() {
            var placeholder = "{{ asset('images/placeholder.svg') }}";
            document.querySelectorAll('img').forEach(function(img) {
                // if image has no src or empty
                if (!img.getAttribute('src')) {
                    img.src = placeholder;
                    img.dataset._fallback = '1';
                    return;
                }
                img.addEventListener('error', function() {
                    if (img.dataset._fallback) return; // avoid loop
                    img.dataset._fallback = '1';
                    img.src = placeholder;
                });
            });
        });
    </script>
</body>

</html>
