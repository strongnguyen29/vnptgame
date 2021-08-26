@extends('backend.main')

@section('head_title', $pageData['title'] ?? 'page title')

@push('head_link_css')
    <!-- Summernote -->
    <link href="{{ asset('backend/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush

@section('main_content')
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-9">
                <x-backend.card>

                    <x-backend.forms.input input-id="inputTitle" name="title" label="Tiêu đề" placeholder="Tiêu đề bài viết" required="true"/>

                    <x-backend.forms.input input-id="inputSlug" name="slug" label="Định danh seo url" placeholder="Định danh seo url"/>

                    <x-backend.forms.text-area name="desc" label="Nội dung ngắn" placeholder="Nội dung ngắn" required="true"/>

                    <x-backend.forms.editor input-id="contentEditor" name="content" label="Nội dung bài viết" required="true"/>

                    <x-backend.forms.input name="meta_title" label="Meta title" placeholder="Meta title"/>

                    <x-backend.forms.text-area name="meta_desc" label="Meta description" placeholder="Meta description"/>

                    <x-backend.forms.input name="tags" label="Tags" help-text="Nhập từ khóa được phân tách bằng dấu ' , '"/>

                </x-backend.card>
            </div>
            <div class="col-3">
                <x-backend.card class="sticky-top">

                    {{-- Language --}}
                    <x-backend.forms.language-select value="{{ request()->get('lang', app()->getLocale()) }}" :readonly="true"/>

                    <button type="submit" name="submit_publish" class="btn btn-primary">Xuất bản</button>
                    <button type="submit" name="submit_draft" class="btn btn-secondary">Lưu nháp</button>
                </x-backend.card>

                <x-backend.card title="Danh mục">
                    <x-backend.forms.category-checkbox :categories="$categories" />
                </x-backend.card>

                <x-backend.card class="post-images" title="Ảnh">

                    <x-backend.forms.input-upload input-id="uploadThumb" name="thumb" label="Ảnh thumb" accept="image/*" required="true"/>

                    <div id="thumbImg">

                    </div>
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


