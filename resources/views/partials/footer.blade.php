<!-- Footer -->
<div class="vl-footer1-section-area sp8">
    <img src="{{ asset('images/elements6.png') }}" alt="" class="elements6">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-logo1">
                    <img src="{{ asset('images/logo.png') }}" alt="">
                    <div class="space16"></div>
                    <p>{{ $siteSettings['site_description'] ?? 'SCF — Nhà phân phối bán buôn các mặt hàng gia dụng và thực phẩm chức năng, cam kết chất lượng và giao hàng đúng hẹn.' }}
                    </p>
                    <div class="space24"></div>
                    <ul>
                        @if(!empty($siteSettings['facebook_url']))
                        <li><a href="{{ $siteSettings['facebook_url'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a></li>
                        @endif
                        @if(!empty($siteSettings['linkedin_url']))
                        <li><a href="{{ $siteSettings['linkedin_url'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        @endif
                        @if(!empty($siteSettings['instagram_url']))
                        <li><a href="{{ $siteSettings['instagram_url'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a></li>
                        @endif
                        @if(!empty($siteSettings['youtube_url']))
                        <li><a href="{{ $siteSettings['youtube_url'] }}" target="_blank" rel="noopener" class="m-0"><i class="fa-brands fa-youtube"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="space30 d-md-none d-block"></div>
                <div class="vl-footer-widget first-padding">
                    <h3>Liên kết nhanh</h3>
                    <div class="space4"></div>
                    <ul>
                        <li><a href="{{ url('/gioi-thieu') }}">Giới thiệu</a></li>
                        <li><a href="{{ url('/san-pham') }}">Sản phẩm</a></li>
                        <li><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>
                        <li><a href="{{ url('/tin-tuc') }}">Blog</a></li>
                        <li><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="vl-footer-widget">
                    <div class="space30 d-lg-none d-block"></div>
                    <h3>Liên hệ</h3>
                    <ul>
                        <li><a href="tel:{{ $siteSettings['contact_phone'] ?? '+84901234567' }}"><img
                                    src="{{ asset('images/phn1.svg') }}"
                                    alt="">{{ $siteSettings['contact_phone'] ?? '+84 90 123 4567' }}</a></li>
                        <li><a href="{{ $siteSettings['google_maps_link'] ?? '#' }}" target="_blank" rel="noopener"><img src="{{ asset('images/location1.svg') }}"
                                    alt="">{{ $siteSettings['office_address'] ?? 'Hà Nội, Việt Nam' }}</a></li>
                        <li><a href="mailto:{{ $siteSettings['contact_email'] ?? 'hello@starvik.vn' }}"><img
                                    src="{{ asset('images/email1.svg') }}"
                                    alt="">{{ $siteSettings['contact_email'] ?? 'hello@starvik.vn' }}</a></li>
                        <li><a href="https://{{ $siteSettings['site_domain'] ?? 'starvik.vn' }}" target="_blank"><img src="{{ asset('images/global1.svg') }}"
                                    alt="">{{ $siteSettings['site_domain'] ?? 'starvik.vn' }}</a>
                        </li>
                    </ul>
                    <div class="space8"></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="vl-footer-widget">
                    <div class="space30 d-lg-none d-block"></div>
                    <h3>Đăng ký nhận tin</h3>
                    <div class="space18"></div>
                    <form>
                        <input type="text" placeholder="Email">
                        <button type="submit" class="vl-btn1">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="space60"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="vl-copyright-area">
                    <p>{{ $siteSettings['footer_copyright'] ?? '© Copyright ' . date('Y') . ' - ' . ($siteSettings['site_name'] ?? 'SCF') . '. All Right Reserved' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
