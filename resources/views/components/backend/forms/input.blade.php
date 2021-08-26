<div {{ $attributes->merge(['class' => 'form-group']) }}>

    @if($label)
        <label class="{{ $labelClass ?? '' }}" for="{{ $inputId ?? 'input_' . $name }}">{{ $label }} @if($required) *  @endif</label>
    @endif

    <input type="{{ $type ?? 'text' }}"
           name="{{ $name }}"
           value="{{ old($name) ?? ($value ?? '') }}"
           id="{{ $inputId ?? 'input_' . $name }}"
           class="form-control {{ $inputClass }} @error($name) is-invalid @enderror"
           placeholder="{{ $placeholder }}"
           @if($required) required  @endif
           @if($readonly) readonly  @endif>

    @if($helpText)
        <small id="{{ $name }}Help" class="form-text text-muted">{{ $helpText }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
