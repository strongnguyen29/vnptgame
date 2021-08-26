@extends('backend.main')

@section('head_title', $pageData['title'] ?? '')

@push('head_end')

@endpush

@push('body_class', 'page-user-role-create')

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.options.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="card-body">

                        @foreach($defaultOptions as $key => $option)
                            @if($option['type'] == 'textArea')
                                <x-backend.forms.text-area :name="$key" :label="$option['label']" :value="$options[$key] ?? $option['value']"/>
                            @else
                                <x-backend.forms.input :name="$key" :label="$option['label']" :value="$options[$key] ?? $option['value']"/>
                            @endif
                        @endforeach

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Lưu</button>
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



