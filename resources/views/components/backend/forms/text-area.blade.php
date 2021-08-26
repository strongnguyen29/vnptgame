<div {{ $attributes->merge(['class' => 'form-group']) }}>

    @if($label)
        <label class="{{ $labelClass ?? '' }}" for="{{ $id ?? 'input_' . $name }}">{{ $label }} @if($required) *  @endif</label>
    @endif

    <textarea name="{{ $name }}"
              id="{{ $id ?? 'input_' . $name }}"
              class="form-control {{ $inputClass }} @error($name) is-invalid @enderror"
              rows="{{ $rows ?? 3 }}"
              placeholder="{{ $placeholder }}"
              @if($required) required  @endif
              @if($readonly) readonly  @endif>{{ old($name) ?? ($value ?? '') }}</textarea>

    @if($helpText)
        <small id="{{ $name }}Help" class="form-text text-muted">{{ $helpText }}</small>
    @endif

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
