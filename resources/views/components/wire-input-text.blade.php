@props([
    'prepend' => '',
    'label' => '',
    'class' => '',
    'id' => mt_rand(1000000, 1999999),
])

<div class="form-group {{ $class }}">
  @if ($label)<label for="{{ $id }}">{{ $label }}</label>@endif
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{{ $prepend }}</div>
      </div>
    @endif
    <input id="{{ $id }}" class="form-control" type="text" {{ $attributes }}>
  </div>
</div>
