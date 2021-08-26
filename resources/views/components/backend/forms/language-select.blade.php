<div {{ $attributes->merge(['class' => 'form-group mb-3']) }}>
    <label for="selectActive">Ngôn ngữ</label>
    <select class="form-control" id="selectLanguage" @if($readonly)  disabled  @endif>
        <option value="vi" {{ $value == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
        <option value="en" {{ $value == 'en' ? 'selected' : '' }}>Tiếng Anh</option>
    </select>
    <input type="hidden" name="language" value="{{ $value }}"/>
</div>
