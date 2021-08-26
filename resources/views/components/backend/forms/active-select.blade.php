<div {{ $attributes->merge(['class' => 'form-group mb-3']) }}>
    <label for="selectActive">Trạng thái</label>
    <select name="active" class="form-control" id="selectActive">
        <option value="1" {{ $checked ? 'selected' : '' }}>Hiện</option>
        <option value="0" {{ !$checked ? 'selected' : '' }}>Ẩn</option>
    </select>
</div>
