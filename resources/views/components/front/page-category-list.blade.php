@if($categories && count($categories) > 0)
<div {{ $attributes->merge(['class' => 'md:flex md:flex-wrap mb-12']) }}>

    @foreach($categories as $cat)
        <a href="{{ route($routeName, $getRouteData($cat['slug'])) }}"
           class="block text-gray-400 mb-2 md:mb-0 md:mr-8 py-0.5 hover-link border-b hover:border-yellow-400 {{ $currentSlug == $cat['slug'] ? 'border-yellow-400' : 'border-gray-850' }}" >
            {{ $cat['title'] }}
        </a>
    @endforeach
</div>
@endif
