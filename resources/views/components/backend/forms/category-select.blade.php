<div class="form-group">
    <label for="selectParent">{{ $label }}</label>
    <select name="{{ $name }}" class="form-control" id="selectParent">

        @if($optionDefault)
            <option value="0">Danh mục gốc</option>
        @endif

        {!! $htmlOptions !!}
    </select>
</div>
