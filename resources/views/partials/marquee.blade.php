<div class="slider1-section-area">
    <div class="marquee-wrap">
        <div class="marquee-text">
            @php
                // Danh mục / sản phẩm nổi bật cho website bán lẻ
                $brands = [
                    'Vật dụng gia đình',
                    'Đồ nhà bếp',
                    'Thực phẩm chức năng',
                    'Chăm sóc cá nhân',
                    'Ưu đãi & Khuyến mãi',
                ];
            @endphp
            @foreach (array_merge($brands, $brands) as $b)
                <div class="brand-single-box">
                    <h3>{{ $b }} <img src="{{ asset('images/elements5.png') }}" alt=""></h3>
                </div>
            @endforeach
        </div>
    </div>
</div>
