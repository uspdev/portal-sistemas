@props([
    'model' => '',
    'options',
    'class' => '',
    'prepend' => '',
])

<div class="form-group ml-2 {{ $class }}">
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{{ $prepend }}</div>
      </div>
    @endif
    <select 
      class="custom-select" 
      wire:model.live="{{ $model }}" 
      {{ $attributes }}>

      {{ $slot }}
      @foreach ($options as $key => $val)
        <option value="{{ $key }}">{{ $val }}</option>
      @endforeach
    </select>
  </div>

  @error($model) <div class="small text-danger">{{ $message }}</div> @enderror
</div>
