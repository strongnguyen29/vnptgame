@extends('backend.main')

@section('head_title', 'Dashboard')

@push('head_link_css')

@endpush

@push('head_end')

@endpush

@push('body_class', 'page-dashboard')

@section('main_content')

    <div class="row">
        <div class="col-12 col-lg-4">
            @include('backend.pages.dashboard.sections.new_posts')
        </div>

        <div class="col-12 col-lg-4">
            @include('backend.pages.dashboard.sections.new_recruitment')
        </div>

        <div class="col-12 col-lg-4">
            @include('backend.pages.dashboard.sections.new_applies')
        </div>
    </div>
@endsection

@push('body_end')

@endpush

