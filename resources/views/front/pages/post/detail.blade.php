@extends('front.main')

@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=1792389047644191&autoLogAppEvents=1" nonce="6umNNb7c"></script>

    <section class="gioithieu tintuc">
        <div class="container gt">
            <div class="row runout">

                <x-front.breadcrumb />

                <div class="col-6"><span class="datetime">{{ $post->created_at->format('H:i, d/m/Y') }}</span></div>

                <x-front.button.share class="col-6" share-link="{{ $post->url }}"/>

                <div class="main-content col-12">
                    <h4>{{ $post->title }}</h4>

                    <div class="font-weight-bold mb-3">
                        <b>{!! $post->desc !!}</b>
                    </div>

                    <div class="post-content mb-4">
                        {!! $post->content !!}
                    </div>

                    <div class="fb-share-button" data-href="{{ $post->url }}"
                         data-layout="button" data-size="small">
                        <a target="_blank"
                           href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                </div>
            </div>

            <div class="container tinkhac">
                <h3 class="text-left">Tin khác</h3>
                <div class="cactin row">
                    <div class="card col-md-4 col-12" style="" data-aos="fade-up" data-aos-duration="400">
                        <img src="images/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <span class="datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> 11:51, 03/08/2021</span>
                            <h5 class="card-title"><a href="#">VNPT GAME ủng hộ 600 triệu đồng cho quỹ mua vaccine ...</a></h5>
                            <p class="card-text">Năm nay, VNPT GAME kỷ niệm lần sinh nhật thứ 6 của mình bằng việc chung tay cùng xã hội chia sẻ những khó khăn với đội ngũ y bác sĩ và bệnh nhân bệnh viện K Tân Triều đẩy lùi dịch bệnh...</p>
                            <a href="#" class="btn" role="button">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card col-md-4 col-12" style="" data-aos="fade-up" data-aos-duration="700">
                        <img src="images/img2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <span class="datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> 11:51, 03/08/2021</span>
                            <h5 class="card-title"><a href="#">“Cố lên Việt Nam”: người VNPT chung tay ủng hộ quỹ phòng chống ...</a></h5>
                            <p class="card-text">Hưởng ứng lời kêu gọi của chính phủ, từ giữa tháng 3/2020 các hoạt động quyên góp, ủng hộ quỹ phòng chống dịch bệnh Covid-19 diễn ra sôi nổi tại cả 2 văn phòng của Funtap ở Hà Nội ...</p>
                            <a href="#" class="btn" role="button">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card col-md-4 col-12" style="" data-aos="fade-up" data-aos-duration="1000">
                        <img src="images/img3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <span class="datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> 11:51, 03/08/2021</span>
                            <h5 class="card-title"><a href="#">Mùa xuân đã kịp về đúng hẹn nơi rẻo cao Pà Vầy Sủ, Hà Giang ...</a></h5>
                            <p class="card-text">Mùa xuân kịp về đúng hẹn với đồng bào dân tộc thiểu số vùng biên nơi rẻo cao cực Bắc Hà Giang khi đoàn từ thiện của Công ty Cổ phần Funtap và Báo điện tử VTC News mang đến những ấm áp...</p>
                            <a href="#" class="btn" role="button">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card col-md-4 col-12" style="" data-aos="fade-up" data-aos-duration="400">
                        <img src="images/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <span class="datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> 11:51, 03/08/2021</span>
                            <h5 class="card-title"><a href="#">VNPT GAME ủng hộ 600 triệu đồng cho quỹ mua vaccine ...</a></h5>
                            <p class="card-text">Năm nay, VNPT GAME kỷ niệm lần sinh nhật thứ 6 của mình bằng việc chung tay cùng xã hội chia sẻ những khó khăn với đội ngũ y bác sĩ và bệnh nhân bệnh viện K Tân Triều đẩy lùi dịch bệnh...</p>
                            <a href="#" class="btn" role="button">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card col-md-4 col-12" style="" data-aos="fade-up" data-aos-duration="700">
                        <img src="images/img2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <span class="datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> 11:51, 03/08/2021</span>
                            <h5 class="card-title"><a href="#">“Cố lên Việt Nam”: người VNPT chung tay ủng hộ quỹ phòng chống ...</a></h5>
                            <p class="card-text">Hưởng ứng lời kêu gọi của chính phủ, từ giữa tháng 3/2020 các hoạt động quyên góp, ủng hộ quỹ phòng chống dịch bệnh Covid-19 diễn ra sôi nổi tại cả 2 văn phòng của Funtap ở Hà Nội ...</p>
                            <a href="#" class="btn" role="button">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card col-md-4 col-12" style="" data-aos="fade-up" data-aos-duration="1000">
                        <img src="images/img3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <span class="datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> 11:51, 03/08/2021</span>
                            <h5 class="card-title"><a href="#">Mùa xuân đã kịp về đúng hẹn nơi rẻo cao Pà Vầy Sủ, Hà Giang ...</a></h5>
                            <p class="card-text">Mùa xuân kịp về đúng hẹn với đồng bào dân tộc thiểu số vùng biên nơi rẻo cao cực Bắc Hà Giang khi đoàn từ thiện của Công ty Cổ phần Funtap và Báo điện tử VTC News mang đến những ấm áp...</p>
                            <a href="#" class="btn" role="button">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
