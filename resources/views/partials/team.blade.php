<div class="team1-section-area sp7">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="team-header heading1 text-center space-margin60">
                    <h5><img src="{{ asset('images/sub-logo2.svg') }}" alt=""> Gặp đội ngũ</h5>
                    <div class="space24"></div>
                    <h2 class="text-anime-style-3">Những chuyên gia giàu kinh nghiệm</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @php
                // Team phục vụ khách hàng bán lẻ
                $members = [
                    ['name' => 'Nguyễn Huy', 'role' => 'Quản lý cửa hàng', 'img' => 'team-img1.png'],
                    ['name' => 'Lê Thu', 'role' => 'Trưởng mua hàng (Bán lẻ)', 'img' => 'team-img2.png'],
                    ['name' => 'Phạm Long', 'role' => 'Chăm sóc khách hàng', 'img' => 'team-img3.png'],
                ];
            @endphp
            @foreach ($members as $m)
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="900">
                    <div class="team-author-boxarea">
                        <img src="{{ asset('images/elements7.png') }}" alt="" class="elements7 keyframe5">
                        <div class="img1">
                            <img src="{{ asset('images/' . $m['img']) }}" alt="">
                        </div>
                        <div class="content-area">
                            <div class="content">
                                <a href="#">{{ $m['name'] }}</a>
                                <div class="space14"></div>
                                <p>{{ $m['role'] }}</p>
                            </div>
                            <div class="share">
                                <a href="#"><img src="{{ asset('images/share1.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#" class="m-0"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
