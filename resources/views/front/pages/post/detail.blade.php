@extends('front.main')

@section('content')

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

                </div>
            </div>

            @include('front.pages.post.components.posts-related')
        </div>
    </section>

@endsection
