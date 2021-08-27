@extends('front.main')

@section('content')

    <section class="gioithieu">
        <div class="container gt">
            <div class="row runout">
                <div class="topgt col-12 justify-content-center">
                    <h3 class="text-center">{{ __('Về Chúng tôi') }}</h3>
                    <h5 class="text-center">{{ __('VNPT GAME') }}</h5>
                    <p>{{ __('about.introduction') }}</p>
                </div>
                <div class="smtn col-12">
                    <img src="{{ asset('images/' . __('about.tam_nhin_img')) }}" alt=""/>
                    <img src="{{ asset('images/' . __('about.cot_loi_img')) }}" alt=""/>
                </div>
            </div>

            @include('front.sections.posts-latest', ['sectionClass' => 'gt'])
        </div>
    </section>

@endsection
