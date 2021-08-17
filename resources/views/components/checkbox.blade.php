<div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" {{ $isChecked == 'true' ? 'checked' : '' }} name="{{$name}}"
        id="{{ $name }}">
    <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
</div>
