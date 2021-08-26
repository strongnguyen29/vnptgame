@extends('front.main')

@push('body_class', 'page-about')

@section('content')

    <div class="w-full relative py-32 lg:py-48">
        <div class="bg-cover bg-bottom absolute inset-0 opacity-50" style="background-image: url({{ asset('images/bg-title.jpg')}})"></div>
    </div>

    <div class="w-full relative pb-16 lg:pt-16 lg:pb-36">
        <div class="container text-center">
            <div class="lg:grid lg:grid-cols-2">
                <div class="text-center lg:text-right lg:pr-8">
                    <h1 class="font-title text-gray-400 font-black drop-shadow text-9xl mb-12">@yield('code')</h1>
                </div>
                <div class="text-center lg:text-left lg:pl-8">
                    <p class="text-2xl uppercase text-gray-400 mt-8 mb-4">@yield('message')</p>
                    <a href="{{ url('/') }}" class="uppercase px-3 py-2 text-gray-500 border border-gray-500 text-xs hover:text-white hover:border-white lg:transition-all lg:duration-200">
                        Quay về trang chủ
                    </a>
                </div>
            </div>

        </div>
    </div>

@endsection
