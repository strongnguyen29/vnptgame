@extends('backend.main')

@section('head_title', 'Danh mục - Tạo mới')

@push('head_link_css')
    <!-- Summernote -->
    <link href="{{ asset('backend/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush

@section('main_content')
    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" value="{{ $_GET['type'] }}">

        <div class="row">
            <div class="col-9">
                <x-backend.card>

                    <x-backend.forms.input name="title" label="Tiêu đề" placeholder="Tiêu đề" required="true"/>

                    <x-backend.forms.input name="slug" label="Định danh" placeholder="Định danh seo url"/>

                    <x-backend.forms.editor input-id="descEditor" name="desc" label="Mô tả"/>

                    <x-backend.forms.input type="number" name="sort" label="Sắp xếp (lớn ưu tiên)" input-class="w-25" value="0"/>

                    <x-backend.forms.input name="meta_title" label="Meta title" placeholder="Meta title"/>

                    <x-backend.forms.text-area name="meta_desc" label="Meta description" placeholder="Meta description"/>
                </x-backend.card>
            </div>
            <div class="col-3">
                <x-backend.card class="sticky-top">
                    <x-backend.forms.language-select value="{{ request()->get('lang', app()->getLocale()) }}" :readonly="true"/>
                    <x-backend.forms.active-select checked="1" />
                    <button type="submit" name="submit_publish" class="btn btn-primary">Tạo mới</button>
                </x-backend.card>

                <x-backend.card title="Danh mục cha">
                    <x-backend.forms.category-select name="parent_id" :categories="$categories"/>
                </x-backend.card>

                <x-backend.card class="category-image" title="Ảnh">
                    <x-backend.forms.input-upload input-id="uploadThumb" name="thumb" label="Ảnh thumb" accept="image/*"/>
                    <div id="thumbImg"></div>
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
            $('#descEditor').summernote({
                minHeight: 200,
                lang: 'vi-VN',
                callbacks: {
                    onImageUpload: function(files) {
                        // upload image to server and create imgNode...
                        //$summernote.summernote('insertNode', imgNode);

                        for (var i = 0; i < files.length; i++) {
                            uploadImage(files[i], function (url) {
                                $('#descEditor').summernote('insertImage', url)
                            });
                        }
                    }
                }
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
        });
    </script>
@endpush


