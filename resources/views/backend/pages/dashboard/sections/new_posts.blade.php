
<x-backend.card title="Tin tức" type="none">

    <x-backend.card-info lang="vi" :total="$totalVi" :public="$publicVi" :private="$privateVi" />

    <x-backend.card-info lang="en" :total="$totalEn" :public="$publicEn" :private="$privateEn" />

    @foreach($posts as $post)
        <div class="row py-2">
            <div class="col-2">
                {!! $post->getImageHtml(['class' => 'img-fluid']) !!}
            </div>
            <div class="col-10">
                <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="d-block text-truncate font-weight-semi-bold">{{ $post->title }}</a>
                <div class="d-flex justify-content-between">
                    <div class="flex">
                        <span class="badge badge-{{ $post->language == 'vi' ? 'danger' : 'info' }}">{{ $post->language }}</span>
                        <span class="badge badge-{{ $post->active ? 'success' : 'secondary' }}">
                            {{ $post->active ? 'Public' : 'Private' }}
                        </span>
                    </div>
                    <span class="font-italic text-muted text-sm">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach

</x-backend.card>
