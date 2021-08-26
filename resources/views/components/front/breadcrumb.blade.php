<nav {{ $attributes->merge(['class' => 'brkcrum']) }} style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url('') }}">{{ __('Trang chủ') }}</a>
        </li>

        @foreach(MetaTag::getBreadcrumb() as $item)
            <li class="breadcrumb-item active" aria-current="page">
                @if(isset($item['url']) && $item['url'])
                    <a href="{{ $item['url'] }}" class="text-decoration-none">
                        {{ $item['title'] }}
                    </a>
                @else
                    <span class="text-truncate">{{ $item['title'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
