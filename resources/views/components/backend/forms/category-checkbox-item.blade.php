<div class="form-check" style="margin-left: {{ $ml }}px">
    <input name="categories[]"
           value="{{ $category->id }}"
           id="inputCat{{ $category->id }}"
           class="form-check-input"
           type="checkbox" {{ in_array($category->id, $values) ? 'checked' : '' }}>

    <label class="form-check-label {{ $category->parent_id ? '' : 'font-weight-semi-bold'}}"
           for="inputCat{{ $category->id }}">
        {{ $category->title }}
    </label>
</div>
