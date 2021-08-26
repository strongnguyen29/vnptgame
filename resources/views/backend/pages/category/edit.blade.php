@extends('backend.main')

@section('head_title', 'Danh mục - sửa')

@push('head_link_css')
    <!-- Summernote -->
    <link href="{{ asset('backend/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush

@section('main_content')
    <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name="type" value="{{ $category->type }}">

        <div class="row">
            <div class="col-9">
                <x-backend.card>
                    <x-backend.forms.input name="title" value="{{ $category->title }}" label="Tiêu đề" placeholder="Tiêu đề" required="true"/>

                    <x-backend.forms.input name="slug"  value="{{ $category->slug }}" label="Định danh" placeholder="Định danh seo url"/>

                    <x-backend.forms.editor input-id="descEditor" name="desc" value="{{ $category->desc }}" label="Mô tả"/>

                    <x-backend.forms.input type="number" name="sort" value="{{ $category->sort }}" label="Sắp xếp (lớn ưu tiên)" input-class="w-25" value="0"/>

                    <x-backend.forms.input name="meta_title" value="{{ $category->meta_title }}" label="Meta title" placeholder="Meta title"/>

                    <x-backend.forms.text-area name="meta_desc" value="{{ $category->meta_desc }}" label="Meta description" placeholder="Meta description"/>
                </x-backend.card>
            </div>
            <div class="col-3">
                <x-backend.card class="sticky-top">
                    <x-backend.forms.language-select value="{{ $category->language }}" :readonly="true"/>
                    <x-backend.forms.active-select checked="{{ $category->active }}" />
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </x-backend.card>

                <x-backend.card title="Danh mục cha">
                    <x-backend.forms.category-select name="parent_id" :categories="$categories" :value="$category->parent_id"/>
                </x-backend.card>

                <x-backend.card class="category-image" title="Ảnh">
                    <x-backend.forms.input-upload input-id="uploadThumb" name="thumb" label="Ảnh thumb" accept="image/*"/>
                    <div id="thumbImg">{{ $category->getImageHtml(['class' => 'img-fluid']) }}</div>
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


