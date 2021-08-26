<form action="{{ request()->fullUrlWithoutQuery('lang') }}" id="formLanguageChange" method="get">
    @foreach(request()->except('lang') as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <select name="lang" class="form-control form-control-sm" id="selectLanguage">
        <option value="vi" {{ request()->get('lang', app()->getLocale()) == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
        <option value="en" {{ request()->get('lang', app()->getLocale()) == 'en' ? 'selected' : '' }}>Tiếng Anh</option>
    </select>
</form>


@push('body_end')
    <script>
        $(function () {
            $('#selectLanguage').change(function () {
                $('#formLanguageChange').submit();
            })
        })
    </script>
@endpush
