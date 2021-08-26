@if($tags && $tags->count() > 0)
    <div {{ $attributes->merge(['class' => 'tags-list']) }}>

        <span class="font-bold mr-3">Tags: </span>

        @foreach($tags as $tag)
            <span class="inline-block bg-white bg-opacity-5 rounded-full px-3 py-1 text-sm font-semibold text-gray-500 mr-2 mb-2">{{ $tag->name }}</span>
        @endforeach
    </div>
@endif
