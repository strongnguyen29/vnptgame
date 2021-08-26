<div {{ $attributes->merge(['class' => 'card card-outline card-'. $type]) }}>
    @if($title)
    <div class="card-header">
        <h3 class="card-title mb-0">{{ $title }}</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    @endif
    <!-- /.card-header -->
    <div class="card-body {{ $bodyClass }}">
        {{ $slot }}
    </div>
    <!-- /.card-body -->
</div>
