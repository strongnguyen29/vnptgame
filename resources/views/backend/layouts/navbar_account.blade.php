<a data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
    <div class="user-panel d-flex">
        <img src="{{ Auth::user()->image ?? asset('backend/images/avatar.png') }}" class="img-circle ml-2 mr-1" alt="User Image">
        <div class="info p-1 text">
            <span class="d-block">{{ Auth::user()->name }}</span>
        </div>
    </div>
</a>

<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header">
        @foreach(Auth::user()->roles as $role)
            @if(!$loop->first)<span class="px-1">|</span>@endif
            {{ $role->name }}
            @endforeach
    </span>
    <div class="dropdown-divider"></div>
    <a href="{{ route('admin.users.show', ['user' => Auth::user()->id]) }}" class="dropdown-item text-center">
        Thông tin tài khoản
    </a>
    <div class="dropdown-divider"></div>
    <form action="{{ route('admin.logout') }}" method="post">
        @csrf
        <button class="dropdown-item dropdown-footer">Đăng xuất</button>
    </form>
</div>
