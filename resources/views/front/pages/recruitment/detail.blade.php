@extends('front.main')

@section('content')

    <section class="gioithieu tintuc tuyendung">
        <div class="container gt">
            <div class="row runout">

                <x-front.breadcrumb />

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row main-content">

                    <div class="tdleft col-md-8 col-12">

                        {!! $recruitment->getImageHtml(['class' => 'w-100 mb-4 h-auto']) !!}

                        <h5>{{ $recruitment->title }}</h5>

                        <div class="post-content mb-4">
                            {!! $recruitment->content !!}
                        </div>
                    </div>
                    {{-- Form đăng ký--}}
                    <div class="tdright col-md-4 col-12">
                        @include('front.pages.recruitment.components.detail_apply_form')
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
