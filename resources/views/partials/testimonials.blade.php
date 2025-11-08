<section class="testimonials-2 sp6"
    style="background-image: url({{ asset('images/bg2.png') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto text-center">
                <div class="heading1 space-margin60">
                    <h5>Phản hồi thực tế</h5>
                    <div class="space20"></div>
                    <h2 class="text-anime-style-3">Khách hàng nói gì về chúng tôi</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-12 left _relative m-auto">
                <div class="swiper swiper-testimonial-2">
                    <div class="swiper-wrapper">
                        @php
                            $testimonials = [
                                [
                                    'name' => 'Nguyễn Thế Anh',
                                    'role' => 'Khách hàng',
                                    'text' =>
                                        'Sản phẩm chất lượng, giao hàng nhanh và đóng gói cẩn thận. Rất hài lòng!',
                                ],
                                [
                                    'name' => 'Đặng Thị Hoa',
                                    'role' => 'Khách hàng',
                                    'text' => 'Dịch vụ chăm sóc khách hàng tận tâm, tư vấn nhiệt tình.',
                                ],
                                [
                                    'name' => 'Cửa hàng đồ gia dụng gia đình Việt',
                                    'role' => 'Nhà bán lẻ',
                                    'text' => 'Sản phẩm đa dạng, hỗ trợ ổn định cho cửa hàng nhỏ như chúng tôi.',
                                ],
                            ];
                        @endphp
                        @foreach ($testimonials as $t)
                            <div class="swiper-slide">
                                <div class="testimonial-boxarea">
                                    <ul>
                                        @for ($s = 0; $s < 5; $s++)
                                            <li><i class="fa-solid fa-star"></i></li>
                                        @endfor
                                    </ul>
                                    <div class="space16"></div>
                                    <p>“{{ $t['text'] }}”</p>
                                    <div class="space32"></div>
                                    <div class="names-area">
                                        <div class="man-textarea">
                                            <div class="text">
                                                <a href="#">{{ $t['name'] }}</a>
                                                <div class="space12"></div>
                                                <p>{{ $t['role'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="map-testimonial">
                <div class="swiper swiper-thumb2">
                    <div class="swiper-wrapper list-img">
                        @for ($i = 5; $i <= 8; $i++)
                            <div class="swiper-slide">
                                <div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
