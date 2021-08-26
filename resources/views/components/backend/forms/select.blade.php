<div class="{{ $attributes->merge(['class' => 'form-group']) }}">

    @if($label)
        <label class="{{ $labelClass ?? '' }}" for="{{ $selectId ?? 'select_' . $name }}">{{ $label }} @if($required) *  @endif</label>
    @endif

        <select class="select2bs4 {{ $inputClass }}"
                id="{{ $selectId ?? 'select_' . $name }}"
                name="{{ $multi ? $name . '[]' : $name }}"
                data-placeholder="Chọn {{ \Illuminate\Support\Str::lower($label) }}"
                @if($multi) multiple="multiple" @endif
                @if($required) required  @endif
                @if($readonly) readonly  @endif>
            @php
                $selectedValue = old($name) ?? ($value ?? ($multi ? [] : ''));
                if($multi && !is_array($selectedValue)) $selectedValue = [$selectedValue]
            @endphp

            @foreach($options as $name => $label)
                @php
                    $isSelect = $multi ? in_array($name, $selectedValue) : $name == $selectedValue;
                @endphp
                <option value="{{ $name ?? '' }}" @if($isSelect) selected @endif>
                    {{ $label ?? 'No-label' }}
                </option>
            @endforeach
        </select>

        @isset($helpText)
            <small class="form-text text-muted">{{ $helpText }}</small>
        @endisset

        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
</div>

@push('head_link_css')
    <!-- Select2 css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('body_end_link_js')
    <!-- Select2 js -->
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}" defer></script>
@endpush

@push('body_end')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('#{{ $selectId ?? 'select_' . $name }}').select2({
                theme: 'bootstrap4',
                disabled: {{ isset($readonly) && $readonly ? 1 : 0 }}
            })
        })
    </script>
@endpush
