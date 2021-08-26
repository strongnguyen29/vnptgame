<div {{ $attributes->merge(['class' => 'form-group']) }}>

    @if($label)
        <label class="{{ $labelClass ?? '' }}" for="{{ $inputId ?? 'upload_' . $name }}">{{ $label }} @if($required) *  @endif</label>
    @endif

    <input type="file"
           name="{{ $name }}"
           id="{{ $inputId ?? 'upload_' . $name }}"
           class="form-control-file {{ $inputClass }} @error($name) is-invalid @enderror"
           @if($required) required  @endif
           @if($multi) multiple  @endif
           @if($accept) accept="{{ $accept }}" @endif>

    @if($helpText)
        <small id="{{ $name }}Help" class="form-text text-muted">{{ $helpText }}</small>
    @endif

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
