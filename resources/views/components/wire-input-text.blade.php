@props([
    'model' => '',
    'prepend' => '',
    'label' => '',
    'class' => '',
    'id' => mt_rand(1000000, 9999999),
])

<div class="form-group {{ $class }} wire-input-text">
  @if ($label)<label for="{{ $id }}">{{ $label }}</label>@endif
  <div class="input-group">
    @if ($prepend)
      <div class="input-group-prepend">
        <div class="input-group-text">{{ $prepend }}</div>
      </div>
    @endif
    <input id="{{ $id }}" class="form-control" type="text" wire:model.blur="{{ $model }}"
      {{ $attributes }} title="ok @error($model){{ $message }}@enderror" />
    </div>
    @error($model) <span class="small text-danger">{{ $message }}</span> @enderror
  </div>

  @Once
    @section('javascripts_bottom')
      @parent
      <script>
        $(function() {
          $('.wire-input-text').find('input').popover({
            html: true,
            placement: 'top'
          })

        })
      </script>
    @endsection

  @endonce
