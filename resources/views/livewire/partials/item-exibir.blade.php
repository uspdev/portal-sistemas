@if ($item->exibir)
  @include('livewire.partials.item-nome')
@else
  <span class="badge text-warning"><i class="fas fa-eye-slash"></i></span>
  @include('livewire.partials.item-nome')
@endif
