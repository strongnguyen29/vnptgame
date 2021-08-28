<footer>
    <div class="menubot">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('front.about') }}">
                    {{ __('Về chúng tôi') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('front.posts.index') }}">{{ __('Tin tức') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Games</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('front.recruitments.index') }}">
                    {{ __('Tuyển dụng') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('front.contact') }}">{{ __('Liên hệ') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">{{ __('Điều khoản sử dụng') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">{{ __('Chính sách bảo mật') }}</a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="row mainfooter">
            <div class="col-md-5 col-12">
                <img src="{{ asset('images/logofooter.png') }}" alt="logo"/>
                <h5>{!! __('contact.company') !!}</h5>
                <p>
                    {!! __('home.footer.chung_nhan_kd') !!}
                </p>
            </div>
            <div class="col-md-7 col-12">
                <div class="lock1">
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ __('home.footer.address') }}</p>
                </div>
                <div class="lock1">
                    <p><i class="fa fa-phone" aria-hidden="true"></i> 024 3772 2728</p>
                </div>
                <div class="lock1">
                    <p><i class="fa fa-volume-control-phone" aria-hidden="true"></i> 024 3772 2733</p>
                </div>
                <div class="lock1">
                    <p><i class="fa fa-envelope" aria-hidden="true"></i> vnptgame@vnpt.vn</p>
                </div>
                <div class="social">
                    <a href="{{ option('fb_page_link') }}" id="share-fb" class="sharer button rounded-circle"><i class="fa  fa-facebook"></i></a>
                    <a href="{{ option('twitter_page_link') }}" id="share-tw" class="sharer button rounded-circle"><i class="fa  fa-twitter"></i></a>
                    <a href="{{ option('linkedin_page_link') }}" id="share-gg" class="sharer button rounded-circle"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footbot">
        <div class="container">
            <p class="">Copyright © 2021 VNPT-GAME. All Rights Reserved</p>
        </div>
    </div>
</footer>
