@extends('backend.main')

@section('head_title', 'Danh mục')

@section('content-header-actions')
    <x-backend.button.add-new route-name="admin.categories.create" :routeData="['type' => $_GET['type']]" />
    @endsection

@section('main_content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="mb-0">Tổng số {{ $categories->count() }} danh mục</p>
        <div class="">
            <x-backend.forms.language-filter />
        </div>
    </div>

    <x-backend.card body-class="p-0">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Img</th>
                <th>Danh mục cha</th>
                <th>Tiêu đề</th>
                <th>Định danh</th>
                <th>Sắp xếp</th>
                <th>Ngôn ngữ</th>
                <th>Active</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)

                @include('backend.pages.category.item_list', ['category' => $category])

                @if($category->children)

                    @foreach($category->children as $subCat)

                        @include('backend.pages.category.item_list', ['category' => $subCat, 'ml' => '-- '])

                        @if($subCat->children)

                            @foreach($subCat->children as $subCat2)

                                @include('backend.pages.category.item_list', ['category' => $subCat2, 'ml' => '-- -- '])

                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if($categories->count() == 0)
                <tr>
                    <td colspan="7" class="py-3 text-muted text-center">Chưa có dữ liệu</td>
                </tr>
            @endif
            </tbody>
        </table>
    </x-backend.card>
@endsection

@push('body_end')
<script>
    $(function () {
        $('.checkbox-active').on('change', function () {
            let value = $(this).is (':checked') ? 1 : 0;

            axios.put(
                    '{{ route('api.categories.active', ['api_token' => Auth::user()->api_token]) }}',
                    {id: $(this).data('id'), 'active': value}
                )
                .then(function (response) {
                    console.log(response.data);
                    if (!response.data.success) {
                        toastr.error(response.data.message)
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    toastr.error('Lỗi update active')
                });
        })
    })
</script>
@endpush


