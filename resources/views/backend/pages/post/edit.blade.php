@extends('backend.main')

@section('head_title', $pageData['title'] ?? 'page title')

@push('head_link_css')
    <!-- Summernote -->
    <link href="{{ asset('backend/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush

@section('main_content')
    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-9">
                <x-backend.card>

                    <x-backend.forms.input input-id="inputTitle" name="title" value="{{ $post->title }}" label="Tiêu đề" placeholder="Tiêu đề bài viết" required="true"/>

                    <x-backend.forms.input input-id="inputSlug" name="slug" value="{{ $post->slug }}" label="Định danh seo url" placeholder="Định danh seo url"/>

                    <x-backend.forms.text-area name="desc" label="Nội dung ngắn" value="{{ $post->desc }}" placeholder="Nội dung ngắn"/>

                    <x-backend.forms.editor input-id="contentEditor" name="content" value="{{ $post->content }}" label="Nội dung bài viết"/>

                    <x-backend.forms.input name="meta_title" label="Meta title" value="{{ $post->meta_title }}" placeholder="Meta title"/>

                    <x-backend.forms.text-area name="meta_desc" label="Meta description" value="{{ $post->meta_desc }}" placeholder="Meta description"/>

                    <x-backend.forms.input name="tags" label="Tags" value="{{ $post->tags->pluck('name')->join(', ') }}"  help-text="Nhập từ khóa được phân tách bằng dấu ' , '"/>

                </x-backend.card>
            </div>
            <div class="col-3">
                <x-backend.card class="sticky-top">

                    <x-backend.forms.language-select value="{{ $post->language }}" :readonly="true"/>

                    <x-backend.forms.active-select checked="{{ $post->active }}" />

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </x-backend.card>

                <x-backend.card title="Danh mục">
                    <x-backend.forms.category-checkbox :categories="$categories" :values="$post->categories->pluck('id')->toArray()"/>
                </x-backend.card>

                <x-backend.card class="post-images" title="Ảnh">

                    <x-backend.forms.input-upload input-id="uploadThumb" name="thumb" label="Ảnh thumb" accept="image/*"/>

                    <div id="thumbImg">{{ $post->getImageHtml(['class' => 'img-fluid']) }}</div>
                </x-backend.card>
            </div>
        </div>
    </form>
@endsection

@push('body_end')
    <!-- Summernote -->
    <script src="{{ asset('backend/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/lang/summernote-vi-VN.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // Summernote
            $('#contentEditor').summernote({
                minHeight: 400,
                lang: 'vi-VN',
                callbacks: {
                    onImageUpload: function(files) {
                        // upload image to server and create imgNode...
                        //$summernote.summernote('insertNode', imgNode);

                        for (var i = 0; i < files.length; i++) {
                            uploadImage(files[i], function (url) {
                                $('#contentEditor').summernote('insertImage', url)
                            });
                        }
                    }
                }
            });

            let autoSlug = '';
            let inputSlug = $('#inputSlug');
            $('#inputTitle').on("change", function(){
                let slug = inputSlug.val();
                if(autoSlug !== slug) {
                    console.log('slug bi sua thu cong: ' + slug);
                    return;
                }

                autoSlug = makeSlug($(this).val());
                inputSlug.val(autoSlug);
            });

            // Preview thumb
            $('#uploadThumb').on("change", function(){

                $('#thumbImg').empty();

                let files = $(this)[0].files;
                if(files.length > 0 ){
                    let reader = new FileReader();
                    reader.onload = function() {
                        $('#thumbImg').html('<img class="img-fluid mb-4" src="' + reader.result + '">');
                    }
                    reader.readAsDataURL(files[0]);
                }
            });
            // Preview gallery image
            $('#uploadGallery').on("change", function(){

                $('#galleryImg').empty();

                let files = $(this)[0].files;
                if(files.length > 0 ){
                    for (let i = 0; i < files.length; i++) {
                        let reader = new FileReader();
                        reader.onload = function() {
                            $('#galleryImg').append('<img class="img-fluid col-6 p-1 shadow-sm" src="' + reader.result + '">');
                        }
                        reader.readAsDataURL(files[i]);
                    }
                }
            });
        });
    </script>
@endpush


