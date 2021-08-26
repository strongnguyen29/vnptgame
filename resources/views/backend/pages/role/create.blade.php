@extends('backend.main')

@section('head_title', $pageData['title'] ?? '')

@push('head_end')
    <style>
        ul.checkbox-tree, ul.checkbox-tree ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ul.checkbox-tree ul {
            padding-left: 1.5rem;
        }

        ul.checkbox-tree li {
            margin: 0 0 5px 0;
        }

        ul.checkbox-tree > li > ul label {
            font-weight: normal !important;
        }
    </style>
    @endpush

@push('body_class', 'page-user-role-create')

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.roles.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        {{-- name input --}}
                        <x-backend.forms.input name="label" label="Tên nhóm" placeholder="Tên nhóm" required="true" input-class="col-6"/>

                        {{-- name input --}}
                        <x-backend.forms.input name="name" label="Slug" placeholder="Slug" required="true" input-class="col-6"/>

                        @include('backend.pages.role.permission')

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Tạo mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
@push('body_end_link_js')
    <!-- Checkbox tree -->
    <script src="{{ asset('backend/plugins/indeterminateCheckbox/indeterminateCheckbox.js') }}"></script>
@endpush

@push('body_end')
    <!-- page script -->
    <script>
        $(function () {
            IndeterminateCheckbox.init();
        });
    </script>
@endpush



