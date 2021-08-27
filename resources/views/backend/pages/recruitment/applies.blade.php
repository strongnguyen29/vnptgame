@extends('backend.main')

@section('head_title', 'Danh sách ứng tuyển')

@section('main_content')

    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="mb-0">Tổng số {{ $recruitmentApplies->total() }} CV ứng tuyển</p>
    </div>

    <x-backend.card body-class="p-0">
        <table class="table table-striped">
            <thead>
            <tr class="text-nowrap">
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Vị trí tuyển</th>
                <th>Tin ứng tuyển</th>
                <th>CV</th>
                <th>Gửi lúc</th>
            </tr>
            </thead>
            <tbody>
            @foreach($recruitmentApplies as $apply)
                <tr>
                    <td>{{ $apply->id }}</td>
                    <td>{{ $apply->full_name }}</td>
                    <td>{{ $apply->email }}</td>
                    <td>{{ $apply->phone }}</td>
                    <td>{{ $apply->position }}</td>
                    <td>
                        <a href="{{ $apply->recruitment->url }}" class="d-inline-block mb-0 text-truncate" style="max-width: 150px">
                            {{ $apply->recruitment->title }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.recruitments.applies.download', ['id' => $apply->id]) }}" class="btn btn-sm btn-info" target="_blank">
                            Download CV
                        </a>
                    </td>
                    <td>{{ $apply->created_at }}</td>
                </tr>
            @endforeach
            @if($recruitmentApplies->total() == 0)
                <tr>
                    <td colspan="8" class="py-3 text-muted text-center">Chưa có dữ liệu</td>
                </tr>
            @endif
            </tbody>
        </table>
    </x-backend.card>

    <div class="my-3 d-flex justify-content-end">
        {!! $recruitmentApplies->withQueryString()->links() !!}
    </div>
@endsection
