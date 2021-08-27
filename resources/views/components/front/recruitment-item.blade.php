@props(['recruitment'])

<div class="card col-md-4 col-12 text-center">
    <div class="card-body">
        <h5 class="card-title">{{ $recruitment->title }}<span class="fake">.</span></h5>
        <p class="card-text">{{ $recruitment->desc ? Str::words($recruitment->desc, 32) : '' }}</p>
        <p class="deadline">Deadline: {{ $recruitment->deadline->format('d/m/Y') }}</p>

        <a href="{{ $recruitment->url }}" class="btn btn-primary">{{ __('Chi tiết') }}</a>
    </div>
</div>
