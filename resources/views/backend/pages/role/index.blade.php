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
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Thêm mới</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Slug</th>
                <th>Quyền hạn</th>
                <th>Cập nhật</th>
                <th>Ngày tạo</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)

                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->label }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @if($role->name == App\Models\User::ROLE_SUPER_ADMIN)
                            Full quyền
                        @else
                            @foreach($role->permissions as $permission)
                                <span class="d-inline-block p-1 m-1 border">{{ $permission->name }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $role->updated_at }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td><x-backend.button.actions model="roles" :routeData="['role' => $role->id]" /></td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </x-backend.card>
@endsection

@push('body_end')

@endpush

