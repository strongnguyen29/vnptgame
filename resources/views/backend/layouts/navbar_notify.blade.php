@isset($notifies)
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ $notifies->count() }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $notifies->count() }} thông báo</span>
        <div class="dropdown-divider"></div>
        @foreach($notifies as $notify)
            <a href="#" class="dropdown-item text-truncate">
                <i class="fas fa-envelope mr-2"></i> {{ $notify->content }}
                <span class="float-right text-muted text-sm">{{ $notify->created_at->diffForHumans() }}</span>
            </a>
        <div class="dropdown-divider"></div>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">Xem tất cả thông báo</a>
    </div>
@endisset
