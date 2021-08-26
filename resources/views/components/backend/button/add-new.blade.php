<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="btnDropdownAddNew" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Thêm mới
    </button>

    <div class="dropdown-menu" aria-labelledby="btnDropdownAddNew">
        <a class="dropdown-item" href="{{ route($routeName, isset($routeData) ? array_merge($routeData, ['lang' => 'vi']) : ['lang' => 'vi']) }}">Tiếng việt</a>
        <a class="dropdown-item" href="{{ route($routeName, isset($routeData) ? array_merge($routeData, ['lang' => 'en']) : ['lang' => 'en']) }}">English</a>
    </div>
</div>
