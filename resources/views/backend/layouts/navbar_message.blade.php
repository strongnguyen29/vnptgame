<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-comments"></i>
    <span class="badge badge-danger navbar-badge">{{ $messages->count() }}</span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    @foreach($messages as $message)
        <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
                <img src="{{ $message->customer->avatar }}" alt="Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                    <h3 class="dropdown-item-title">
                        {{ $message->customer->name }}
                    </h3>
                    <p class="text-sm text-truncate">{{ $message->content }}</p>
                    <p class="text-sm text-muted">
                        <i class="far fa-clock mr-1"></i> {{ $message->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
            <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
    @endforeach
    <a href="#" class="dropdown-item dropdown-footer">Xem tất cả</a>
</div>
