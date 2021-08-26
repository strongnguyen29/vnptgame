@extends('backend.main')

@section('head_title', 'Baì viết')

@section('content-header-actions')
    <x-backend.button.add-new route-name="admin.posts.create" />
@endsection

@section('main_content')

    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="mb-0">Tổng số {{ $posts->total() }} bài viết</p>
        <div class="">
            <x-backend.forms.language-filter />
        </div>
    </div>

    <x-backend.card body-class="p-0">
        <table class="table table-striped">
            <thead>
            <tr class="text-nowrap">
                <th>ID</th>
                <th>Img</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Active</th>
                <th>Ngôn ngữ</th>
                <th>Cập nhật</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)

                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->getImageHtml(['class' => 'img-thumbnail', 'style' => 'width: 72px']) ?? 'No image' }}</td>
                    <td class="font-weight-semi-bold">{{ $post->title }}</td>
                    <td>{{ $post->categories->count() > 0 ? $post->categories->pluck('title')->join(', ') : 'Empty' }}</td>
                    <td>
                        @if ($post->active)
                            <span class="btn btn-sm btn-success text-nowrap">Hiện</span>
                        @else
                            <span class="btn btn-sm btn-secondary text-nowrap">Ẩn</span>
                        @endif
                    </td>
                    <td>{{ $post->languageName }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <x-backend.button.actions model="posts" :routeData="['post' => $post->id]" />
                    </td>
                </tr>


            @endforeach
            @if($posts->count() == 0)
                <tr>
                    <td colspan="8" class="py-3 text-muted text-center">Chưa có dữ liệu</td>
                </tr>
            @endif
            </tbody>
        </table>
    </x-backend.card>

    <div class="my-3 d-flex justify-content-end">
        {!! $posts->withQueryString()->links() !!}
    </div>
@endsection

@push('body_end')
    <script>
        $(function () {
            $('#selectLanguage').change(function () {
                $('#formLanguageChange').submit();
            })
        })
    </script>
@endpush


