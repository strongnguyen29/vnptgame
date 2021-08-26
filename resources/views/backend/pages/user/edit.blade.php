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
                <form class="form-horizontal" action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        {{-- name input --}}
                        <x-backend.forms.input name="name" :value="$user->name" label="Tên" placeholder="Tên" required="true" input-class="col-6"/>

                        {{-- name input --}}
                        <x-backend.forms.input name="email" :value="$user->email" label="Email" placeholder="Email" required="true" input-class="col-6"/>

                        {{-- name input --}}
                        <x-backend.forms.input type="password" name="password" label="Mật khẩu" placeholder="Mật khẩu" input-class="col-6"/>
                        {{-- name input --}}
                        <x-backend.forms.input type="password" name="password_confirmation" label="Nhập lại mật khẩu" placeholder="Nhập lại mật khẩu" input-class="col-6"/>

                        <x-backend.forms.select name="roles" :options="$roles" :value="$user->roles->pluck('name')->toArray()" label="Nhóm" select-id="selectRoles" input-class="col-6" required="true" multi="true"/>

                        <div class="mb-3">
                            <p class="mt-3 mb-2 font-weight-bold">Active</p>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="radioActive1" name="active" value="1"
                                       class="custom-control-input" {{ $user->active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="radioActive1">Mở</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="radioActive0" name="active" value="0"
                                       class="custom-control-input" {{ $user->active ? '' : 'checked' }}>
                                <label class="custom-control-label" for="radioActive0">Khóa</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

@push('body_end')

@endpush



