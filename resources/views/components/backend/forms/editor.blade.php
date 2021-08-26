<div {{ $attributes->merge(['class' => 'form-group']) }}>

    @if($label)
        <label class="{{ $labelClass ?? '' }}" for="{{ $inputId ?? 'editor_' . $name }}">{{ $label }} @if($required) *  @endif</label>
    @endif

    @if($helpText)
        <small id="{{ $name }}Help" class="form-text text-muted">{{ $helpText }}</small>
    @endif
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <textarea name="{{ $name }}" id="{{ $inputId ?? 'editor_' . $name }}" @if($required) required  @endif>{!! old($name) ?? ($value ?? '') !!}</textarea>

</div>


