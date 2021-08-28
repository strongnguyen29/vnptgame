
<x-backend.card title="CV Ứng tuyển mới" type="none">

    @foreach($applies as $apply)
        <div class="row py-2 border-bottom">

            <div class="col">
                <p class="d-block text-truncate font-weight-bold mb-0">{{ $apply->full_name }}</p>
                <span class="badge badge-info">{{ $apply->position }}</span>
                <span class="badge badge-success">{{ $apply->phone }}</span>
                <span class="badge badge-secondary">{{ $apply->email }}</span>
            </div>

            <div class="col-auto text-right">
                <a href="" class="btn btn-xs btn-primary"><i class="fas fa-download mr-2"></i> CV</a>
                <p class="font-italic text-muted text-sm mb-0">
                    {{ $apply->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
    @endforeach

</x-backend.card>
