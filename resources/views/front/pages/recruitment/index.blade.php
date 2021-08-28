@extends('front.main')

@section('content')

    <section class="gioithieu tintuc tuyendung">
        <div class="container gt">
            <div class="row runout">

                <x-front.breadcrumb />

                <h3 class="text-center">{{ __('Vì sao bạn chọn chúng tôi') }}<span class="fake">.</span></h3>

                @include('front.pages.recruitment.components.index_desc')

                <h3 class="text-center">{{ __('Các vị trí đang tuyển') }}<span class="fake">.</span></h3>

                @include('front.pages.recruitment.components.index_categories')

                <div class="row tab-content">

                    @if($recruitments->total() > 0)
                        @foreach($recruitments as $recruitment)
                            <x-front.recruitment-item :recruitment="$recruitment" />
                        @endforeach
                    @else
                        <div class="col-12 text-center">{{ __('Không có tin nào!') }}</div>
                    @endif

                    {!! $recruitments->withQueryString()->links() !!}

                </div>
            </div>
        </div>
    </section>

@endsection
