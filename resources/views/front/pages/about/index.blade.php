@extends('front.main')

@section('content')

    <section class="gioithieu">
        <div class="container gt">
            <div class="row runout">
                <div class="topgt col-12 justify-content-center">
                    <h3 class="text-center">Về Chúng tôi</h3>
                    <h5 class="text-center">VNPT GAME</h5>
                    <p>Công ty được thành lập từ Tháng 8/2021 và có đội ngũ nhân sự đông đảo lên tới hơn 100 người, với thành phần cốt lõi đến từ các nhà phát hành game lớn của Việt nam
                        Lĩnh vực kinh doanh chính của chúng tôi là Phát hành game, thể thao điện tử, PR Marketing
                    </p>
                </div>
                <div class="smtn col-12">
                    <img src="{{ asset('images/tnsm.jpg') }}" alt=""/>
                    <img src="{{ asset('images/gtcl.jpg') }}" alt=""/>
                </div>
            </div>
        </div>
    </section>

    @include('front.sections.posts-latest')

@endsection
