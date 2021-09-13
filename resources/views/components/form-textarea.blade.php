@props([
    'prepend' => '',
    'label' => '',
    'class' => '',
    'value' => '',
    'rows' => 3,
])

<div class="form-group {{ $class }}">
  @if ($label)<label>{{ $label }}</label>@endif
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{{ $prepend }}</div>
      </div>
    @endif
    <textarea class="form-control" rows="{{ $rows }}" {{ $attributes }}></textarea>
  </div>
</div>
