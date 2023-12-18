<div class="card mb-3">
  <div class="card-header py-2">
    <span class="h4 py-0">
      @if (!$grupo->exibir)
        <span class="badge text-warning"><i class="fas fa-eye-slash"></i></span>
      @endif
      {{ $grupo->nome }}
    </span>
    @includeWhen(Gate::allows('manager'), 'livewire.partials.badge-grupo-sem-coluna')
    @includeWhen($gerenciar, 'livewire.partials.grupo-menu')
    <div class="text-secondary">{{ $grupo->descricao }}</div>
  </div>

  <div class="card-body">
    <ul wire:sortable="updateItensOrder" class="list-group">
      @foreach ($grupo->itens as $item)
        <li wire:sortable.item="{{ $item->id }}" wire:key="item-{{ $item->id }}"
          class="list-group-item border-0 py-0 px-0">
          <div class="form-inline">
            @if ($gerenciar)
              {{-- <span wire:sortable.handle class="mr-1"><i class="fas fa-grip-lines text-secondary"></i></span> --}}
            @endif
            @includeWhen($item->exibir || Gate::check('manager'), 'livewire.partials.item')
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
