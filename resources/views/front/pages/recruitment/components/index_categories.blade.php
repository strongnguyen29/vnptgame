<div class="navbar navbar-light justify-content-center">
    <div class="navbar-nav-scroll customnav">
        <ul class="navbar-nav bd-navbar-nav flex-row nav nav-pills" id="pills-tab">

            <li class="nav-item">
                <a href="{{ route('front.recruitments.index') }}" class="nav-link {{ !isset($_GET['category_id']) ? 'active' : '' }}">
                    {{ __('Tất cả') }}
                </a>
            </li>

            @foreach($categories as $category)
                <li class="nav-item">
                    <a class="nav-link {{ isset($_GET['category_id']) && $_GET['category_id'] == $category->id ? 'active' : '' }}" href="{{ route('front.recruitments.index', ['category_id' => $category->id]) }}">
                        {{ $category->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
