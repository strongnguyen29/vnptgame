<div class="container tinkhac">
    <h3 class="text-left">{{ __('Tin khác') }}</h3>
    <div class="cactin row">

        @foreach($relatedPosts as $post)
            <x-front.post-item :post="$post" class="col-md-4 col-12" />
        @endforeach
    </div>
</div>
