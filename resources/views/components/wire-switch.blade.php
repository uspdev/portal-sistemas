@props([
    'model' => '',
    'label' => '',
    'class' => '',
    'id' => mt_rand(1000000, 1999999),
])

<div class="custom-control custom-switch ml-2 mt-2 {{ $class }}">
  <input 
    type="checkbox"
    class="custom-control-input"
    id="{{ $id }}"
    wire:model.live="{{ $model }}"
    {{ $attributes }}
  />
  @if ($label)
    <label class="custom-control-label" for="{{ $id }}">{{ $label }}</label>
  @endif
</div>
