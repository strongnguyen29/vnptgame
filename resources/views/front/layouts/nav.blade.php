<nav class="navbar navbar-expand-lg navbar-light topnav fixed-top navvnpt">
    <div class="search-inline off">
        <form id="searchForm">
            <input type="text" class="form-control1 input_search" name="key" placeholder="Tìm kiếm...">
            <button type="submit" class="btn_search">
                <i class="fa fa-search"></i>
            </button>
            <a href="javascript:void(0)" class="search-close">
                <i class="fa fa-times"></i>
            </a>
        </form>
    </div>
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}" alt="menu-btn"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <x-front.nav-item route-name="front.home" title="{{ __('Trang chủ') }}" />
                <x-front.nav-item route-name="front.about" title="{{ __('Về chúng tôi') }}" />
                <x-front.nav-item route-name="front.services" title="{{ __('Dịch vụ') }}" />
                <x-front.nav-item route-name="front.posts.index" title="{{ __('Tin tức') }}" />
                <x-front.nav-item route-name="front.recruitments.index" title="{{ __('Tuyển dụng') }}" />
                <x-front.nav-item route-name="front.contact" title="{{ __('Liên hệ') }}" />

                @include('front.layouts.language')
            </ul>
            <div class="searching">
                <center class="bt-menu">
                    <a href="javascript:void(0)" class="search-open">
                        <span><i class="fa fa-search"></i></span>
                    </a>
                </center>
            </div>
        </div>
    </div>
</nav>

@push('body_end')
    <script  type="text/javascript">
        $( document ).ready(function() {
            $('.search-open').click(function(){
                $('.search-inline').toggleClass('on off');
            })
            $('.search-close').click(function(){
                $('.search-inline').removeClass('on').addClass('off');
            })
        });
    </script>
    @endpush
