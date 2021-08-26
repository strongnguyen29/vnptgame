<li class="nav-item">
    <a class="nav-link {{ Route::currentRouteName() == $routeName ? 'active' : '' }}" href="{{ route($routeName) }}">
        {{ $title }}
    </a>
</li>
