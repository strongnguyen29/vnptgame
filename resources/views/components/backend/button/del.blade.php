<form action="{{ route($routeName, $routeData) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-sm btn-danger {{ $btnClass }}" onclick="return confirm('Chắc chắn xoá?')">
        {!! $btnText ?? '<i class="fas fa-trash-alt"></i>' !!}
    </button>
</form>
