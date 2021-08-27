@extends('backend.main')

@section('head_title', 'Tin tuyển dụng')

@section('content-header-actions')
    <x-backend.button.add-new route-name="admin.recruitments.create" />
@endsection

@section('main_content')

    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="mb-0">Tổng số {{ $recruitments->total() }} tin</p>
        <div class="">
            <x-backend.forms.language-filter />
        </div>
    </div>

    <x-backend.card body-class="p-0">
        <table class="table table-striped">
            <thead>
            <tr class="text-nowrap">
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Active</th>
                <th>Ứng tuyển</th>
                <th>Hết hạn</th>
                <th>Ngôn ngữ</th>
                <th>Cập nhật</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($recruitments as $recruitment)

                <tr>
                    <td>{{ $recruitment->id }}</td>
                    <td>{{ $recruitment->getImageHtml(['class' => 'img-thumbnail', 'style' => 'width: 64px']) ?? 'No image' }}</td>
                    <td class="font-weight-semi-bold">{{ $recruitment->title }}</td>
                    <td>{{ $recruitment->categories->count() > 0 ? $recruitment->categories->pluck('title')->join(', ') : 'Empty' }}</td>
                    <td>
                        @if ($recruitment->active)
                            <span class="btn btn-sm btn-success text-nowrap">Hiện</span>
                        @else
                            <span class="btn btn-sm btn-secondary text-nowrap">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        {{ number_format($recruitment->applies_count) }} CV
                        <a href="{{ route('admin.recruitments.applies', ['recruitment_id' => $recruitment->id]) }}">(Xem ds)</a>
                    </td>
                    <td>{{ $recruitment->deadline->format('d/m/Y') }}</td>
                    <td>{{ $recruitment->languageName }}</td>
                    <td>{{ $recruitment->updated_at }}</td>
                    <td>
                        <x-backend.button.actions model="recruitments" :routeData="['recruitment' => $recruitment->id]" />
                    </td>
                </tr>


            @endforeach
            @if($recruitments->count() == 0)
                <tr>
                    <td colspan="8" class="py-3 text-muted text-center">Chưa có dữ liệu</td>
                </tr>
            @endif
            </tbody>
        </table>
    </x-backend.card>

    <div class="my-3 d-flex justify-content-end">
        {!! $recruitments->withQueryString()->links() !!}
    </div>
@endsection


