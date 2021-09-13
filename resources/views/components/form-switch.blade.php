@props([
    'label' => '',
    'class' => '',
])

<div class="btn custom-control custom-switch {{ $class }}">
  <input type="checkbox" class="custom-control-input" id="customSwitch1" {{ $attributes }}>
  @if ($label)<label class="custom-control-label" for="customSwitch1">{{ $label }}</label>@endif
</div>