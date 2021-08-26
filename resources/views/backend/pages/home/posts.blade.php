@extends('backend.main')

@section('head_title', 'Cài đặt trang chủ')

@section('main_content')
    <div class="row">

        {{--  form add new --}}
        <div  class="col-5">
            <x-backend.card title="Thêm bài viết vào trang chủ">

                <form action="{{ route('admin.home.posts.add') }}" method="post">
                    @csrf
                    @method('put')
                    <x-backend.forms.select name="id" :options="$posts" label="Chọn từ danh sách baif viết" input-class="col-12 mb-2" select-id="selectProject" required="true"/>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </x-backend.card>
        </div>

        {{-- menu editor --}}
        <div  class="col-6">
            <x-backend.card title="Bài viết đang hiện ở trang chủ">
                <ul id="menuEditor" class="list-unstyled">
                    @foreach($homePosts as $post)
                        <li id="{{ \App\Models\Option::HOME_POSTS . '_' . $post['id'] }}" class="w-100">
                            <div class="d-flex align-items-center justify-content-between py-2 px-3 shadow-sm rounded-sm my-1 border">
                                <span class="font-weight-bold">{{ $post['title'] ?? 0 }}</span>
                                <div class="d-flex align-items-center">
                                    <x-backend.button.del route-name="admin.home.posts.del" :routeData="['id' => $post['id']]" />
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </x-backend.card>
        </div>
    </div>

@endsection

@push('head_end')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endpush

@push('body_end_link_js')
@endpush

@push('body_end')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $( "#menuEditor" ).sortable({
                axis: 'y',
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    axios.put('{{ route('api.home.posts.sort', ['api_token' => Auth::user()->api_token]) }}', {data: data})
                        .then(function (response) {
                            console.log(response.data);
                        })
                }
            });
        } );
    </script>
@endpush


