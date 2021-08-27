<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light"><b>VNPT GAME</b> CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">

                @php
                    $sidebar = config('backend.sidebar', []);
                    $currentRouteName = \Illuminate\Support\Facades\Route::currentRouteName();
                @endphp
                @foreach($sidebar as $item)

                    @if($item['type'] == 'header')

                        <li class="nav-header text-uppercase">{{ $item['title'] }}</li>

                    @elseif($item['type'] == 'item')
                        @if(!isset($item['gate']) || Gate::allows($item['gate']))

                            <li class="nav-item">
                                <a class="nav-link @if(isset($item['route']) && $currentRouteName ==  $item['route']) active @endif"
                                   href="{{ isset($item['url']) ? $item['url'] : route($item['route'], $item['routeData'] ?? []) }}" @isset($item['url']) target="_blank" @endisset>
                                    <i class="{{ $item['icon'] ?? 'fas fa-circle' }} nav-icon"></i>
                                    <p>{{ $item['title'] }}</p>
                                </a>
                            </li>

                        @endif

                    @elseif($item['type'] == 'treeview')

                        @php
                            // Chech xem menu co it nhat 1 con co dc phep hien thi ko
                            $canViewMenu = false;
                            foreach ($item['items'] as $subItem) {
                                if(!isset($subItem['gate']) || Gate::allows($subItem['gate'])) {
                                    $canViewMenu = true;
                                }
                            }
                        @endphp

                        @if($canViewMenu)
                            @php
                                $isMenuOpen = array_search($currentRouteName, array_column($item['items'], 'route')) !== false;
                            @endphp
                            <li class="nav-item has-treeview @if($isMenuOpen) menu-open @endif">
                                <a href="#" class="nav-link @if($isMenuOpen) active @endif">
                                    <i class="{{ $item['icon'] ?? 'fas fa-circle' }} nav-icon"></i>
                                    <p>
                                        {{ $item['title'] }}
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if($isMenuOpen) style="display: block;" @endif>

                                    @foreach($item['items'] as $subItem)
                                        @if(!isset($subItem['gate']) || Gate::allows($subItem['gate']))

                                            <li class="nav-item">
                                                <a class="nav-link @if(isset($subItem['route']) && $currentRouteName ==  $subItem['route']) active @endif"
                                                   href="{{ route( $subItem['route'], $subItem['routeData'] ?? []) }}">
                                                    <i class="{{ $subItem['icon'] ?? 'far fa-circle' }} nav-icon"></i>
                                                    <p>{{ $subItem['title'] }}</p>
                                                </a>
                                            </li>

                                        @endif
                                    @endforeach

                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
