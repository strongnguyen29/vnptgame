<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        {{--<li class="nav-item dropdown">
            @include('layouts.navbar_notify')
        </li>--}}

        <li class="nav-item dropdown">
            @include('backend.layouts.navbar_account')
        </li>
    </ul>
</nav>
