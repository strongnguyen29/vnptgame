@extends('backend.main')

@section('head_title', $pageData['title'] ?? '')

@push('head_link_css')

@endpush

@push('head_end')

@endpush

@push('body_class', 'page-dashboard')

@section('main_content')
    <x-backend.card>
        <div class="mb-2">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Thêm mới</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th>Active</th>
                <th>Cập nhật</th>
                <th>Ngày tạo</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="d-inline-block p-1 m-1 border">{{ $role->label }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if($user->active)
                            <span class="badge badge-success">Mở</span>
                        @else
                            <span class="badge badge-secondary">Khóa</span>
                        @endif
                    </td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td><x-backend.button.actions model="users" :routeData="['user' => $user->id]" /></td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </x-backend.card>
@endsection

@push('body_end')

@endpush

