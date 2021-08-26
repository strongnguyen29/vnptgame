<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i>
                {{ __('Trang chủ') }}
            </a>
        </li>

        @foreach($breadcrumb as $item)
            @if(isset($item['url']) || isset($item['route']))
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] ?? (route($item['route']) ?? '#') }}">
                        {{ $item['title'] }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active">{{ $item['title'] }}</li>
            @endif
        @endforeach
    </ol>
</div><!-- /.col -->
