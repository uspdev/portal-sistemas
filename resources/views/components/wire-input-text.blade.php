@props([
    'prepend' => '',
    'label' => '',
    'class' => '',
])

<div class="form-group {{ $class }}">
  @if ($label)<label>{{ $label }}</label>@endif
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{{ $prepend }}</div>
      </div>
    @endif
    <input class="form-control" type="text" {{ $attributes }}>
  </div>
</div>
