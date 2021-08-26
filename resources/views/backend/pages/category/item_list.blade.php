<tr>
    <td>{{ $category->id }}</td>
    <td>{{ $category->getImageHtml(['class' => 'img-thumbnail', 'style' => 'width: 100px']) ?? 'No image' }}</td>
    <td>
        @if($category->parent)
        {{ $category->parent->title }}
        @else
        <span class="text-muted">Root</span>
        @endif
    </td>
    <td><span class="d-block">{{ $ml ?? '' }}{{ $category->title }}</span></td>
    <td>{{ $category->slug }}</td>
    <td>{{ $category->sort }}</td>
    <td>{{ $category->languageName }}</td>
    <td>
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" id="checkboxActive{{ $category->id }}" class="custom-control-input checkbox-active" value="1"
                       data-id="{{ $category->id }}"{{ $category->active ? 'checked' : '' }}>
                <label class="custom-control-label" for="checkboxActive{{ $category->id }}"></label>
            </div>
        </div>
    </td>
    <td>
        <x-backend.button.actions model="categories" :routeData="['category' => $category->id]" />
    </td>
</tr>
