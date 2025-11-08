<!-- Header -->
<header class="homepage1-menu">
    <div id="vl-header-sticky" class="vl-header-area vl-transparent-header">
        <div class="container headerfix">
            <div class="row align-items-center row-bg1">
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="vl-logo">
                        @php $logo = $siteSettings['logo'] ?? null; @endphp
                        <a href="{{ url('/') }}">
                            <img src="{{ asset_url($logo ?: 'images/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="vl-main-menu text-center">
                        <nav class="vl-mobile-menu-active">
                            <ul>
                                <li class="has-dropdown"><a href="{{ url('/') }}">Trang chủ</a></li>
                                <li class="has-dropdown"><a href="{{ url('/gioi-thieu') }}">Giới thiệu</a></li>
                                <li><a href="{{ url('/san-pham') }}">Sản phẩm</a></li>
                                <li><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>
                                <li><a href="{{ url('/tin-tuc') }}">Blog</a></li>
                                <li><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="vl-hero-btn d-none d-lg-block text-end">
                        <span class="vl-btn-wrap text-end">
                            <a href="{{ url('/lien-he') }}" class="vl-btn1"
                                style="overflow: hidden;">{{ $siteSettings['contact_button_label'] ?? 'Liên hệ' }}</a>
                        </span>
                        <button class="hamburger_menu"><img src="{{ asset('images/bars-icons1.svg') }}"
                                alt=""></button>
                    </div>
                    <div class="vl-header-action-item d-block d-lg-none">
                        <button type="button" class="vl-offcanvas-toggle">
                            <i class="fa-solid fa-bars-staggered"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Sidebar / Mobile menu (kept minimal) -->
<div class="header-search-form-wrapper">
    <div class="tx-search-close tx-close"><i class="fa-solid fa-xmark"></i></div>
    <div class="header-search-container">
        <form role="search" class="search-form">
            <input type="search" class="search-field" placeholder="Tìm kiếm …" value="" name="s">
            <button type="submit" class="search-submit"><img src="{{ asset('images/search1.svg') }}"
                    alt=""></button>
        </form>
    </div>
</div>
<div class="body-overlay"></div>
