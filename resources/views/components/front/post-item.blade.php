@props(['post'])

<div {{ $attributes->merge(['class' => 'card', 'data-aos' => 'fade-up', 'data-aos-duration' => 400]) }}>

    @if($post->thumb)
        {!! $post->getImageHtml(['class' => 'card-img-top', 'alt' => $post->title]) !!}
    @else
        <img src="{{ asset('images/post_thumb.jpg') }}" class="card-img-top" alt="post thumb default" />
    @endif
    <div class="card-body">
        <span class="datetime">
            <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $post->created_at->format('H:i, d/m/Y') }}
        </span>
        <h5 class="card-title text-truncate">
            <a href="{{ $post->url }}">{{ $post->title ?? '' }}</a>
        </h5>
        <p class="card-text">{{ $post->desc ? Str::words($post->desc, 24) : '' }}</p>
        <a href="{{ $post->url }}" class="btn btn-outline-primary rounded-pill" role="button">{{ __('Chi tiết') }}</a>
    </div>
</div>
