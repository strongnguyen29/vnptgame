
<div {{ $attributes->merge(['class' => 'bg-light mb-1 p-2 rounded-1']) }}>
    @isset($lang)
    <span class="mr-2 badge badge-{{ $lang == 'vi' ? 'danger' : 'info' }}">{{ Str::upper($lang) }}</span>
    @endisset
    Tổng {{ $total }} bài <span class="text-muted px-2">|</span> {{ $public }} public <span class="text-muted px-2">|</span> {{ $private }} private
</div>
