<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="google-site-verification" content="{{ option('google_site_verification', config('options.google_site_verification.value')) }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ MetaTag::get('title') }}</title>
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::canonical() !!}
    {!! MetaTag::openGraph() !!}

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/main-sgcp.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/aos.css') }}" rel="stylesheet" type="text/css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5PZZSFSXY8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ option('ga_code', config('options.ga_code.value')) }}');
    </script>

    @stack('head_end')
</head>
<body class="@stack('body_class')" data-aos-easing="ease-in-out-sine" data-aos-duration="400" data-aos-delay="00">

    @include('front.layouts.nav')

    @include('front.sections.slider')

    @yield('content')

    @include('front.sections.doi-tac')

    @include('front.layouts.footer')

<!-- Scripts -->
<!-- jQuery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>

    @stack('body_end')

    <script>
        AOS.init({
            easing: 'ease-in-out-sine'
        });
    </script>
</body>
</html>
