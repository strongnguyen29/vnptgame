@extends('front.main')

@section('content')

    <section class="gioithieu tintuc tuyendung">
        <div class="container gt">
            <div class="row runout">

                <x-front.breadcrumb />

                <h3 class="text-center">{{ __('Tin Tức') }}<span class="fake">.</span></h3>

                @include('front.pages.post.components.index_categories')

                <div class="row cactin">

                    @if($posts->total() > 0)
                        @foreach($posts as $post)

                            <x-front.post-item :post="$post" class="col-12 col-md-6 col-lg-4"/>

                        @endforeach
                    @else
                        <div class="col-12 text-center">{{ __('Không có tin nào!') }}</div>
                    @endif

                    {!! $posts->withQueryString()->links() !!}

                </div>
            </div>
        </div>
    </section>

@endsection
