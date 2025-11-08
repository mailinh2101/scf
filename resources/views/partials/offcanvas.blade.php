<!-- Offcanvas / Sidebar / Mobile menu -->
<div class="header-site-icon">
    <div class="slide-bar slide-bar1">
        <div class="sidebar-info">
            <div class="sidebar-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo1.png') }}" alt="logo">
                </a>
                <div class="close-mobile-menu">
                    <a><i class="fa-solid fa-xmark"></i></a>
                </div>
            </div>
            <div class="sidebar-content">
                <ul>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a href="{{ url('/gioi-thieu') }}">Giới thiệu</a></li>
                    <li><a href="{{ url('/san-pham') }}">Sản phẩm</a></li>
                    <li><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>
                    <li><a href="{{ url('/tin-tuc') }}">Blog</a></li>
                    <li><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
                </ul>
            </div>
            <div class="space32"></div>
            <div class="btn-area">
                <a href="{{ url('/lien-he') }}" class="vl-btn1" style="overflow: hidden;">Liên hệ ngay</a>
            </div>
            <div class="space40"></div>
            <div class="social-link-area">
                <h3 class="sidebar-heading">Mạng xã hội</h3>
                <ul>
                    <li>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </li>
                </ul>
            </div>
            <div class="space40"></div>
            <div class="form-area">
                <h3>Đăng ký nhận tin</h3>
                <form>
                    <input type="text" placeholder="Địa chỉ Email*">
                    <button type="submit" class="vl-btn1" style="overflow: hidden;">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
    <div class="body-overlay"></div>
</div>

<!-- Mobile offcanvas -->
<div class="homepage1-menu">
    <div class="vl-offcanvas">
        <div class="vl-offcanvas-wrapper">
            <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-90">
                <div class="vl-offcanvas-logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('images/logo1.png') }}" alt=""></a>
                </div>
                <div class="vl-offcanvas-close">
                    <button class="vl-offcanvas-close-toggle"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>

            <div class="vl-offcanvas-menu d-lg-none mb-40">
                <nav>
                    <ul>
                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li><a href="{{ url('/gioi-thieu') }}">Giới thiệu</a></li>
                        <li><a href="{{ url('/san-pham') }}">Sản phẩm</a></li>
                        <li><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>
                        <li><a href="{{ url('/tin-tuc') }}">Blog</a></li>
                        <li><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>

            <div class="space20"></div>
            <div class="vl-offcanvas-info">
                <h3 class="vl-offcanvas-sm-title">Liên hệ</h3>
                <div class="space20"></div>
                <span><a href="#"> <i class="fa-regular fa-envelope"></i> +84 90 123 4567</a></span>
                <span><a href="#"><i class="fa-solid fa-phone"></i> hello@scf.vn</a></span>
                <span><a href="#"><i class="fa-solid fa-location-dot"></i> Hà Nội, Việt Nam</a></span>
            </div>
            <div class="space20"></div>
            <div class="vl-offcanvas-social">
                <h3 class="vl-offcanvas-sm-title">Theo dõi chúng tôi</h3>
                <div class="space20"></div>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

        </div>
    </div>
    <div class="vl-offcanvas-overlay"></div>
</div>
