<div class="card mb-3">
  <div class="card-header to-hover py-2">
    <span class="h4 py-0">

      @if (!$grupo->exibir)
        <span class="badge text-warning"><i class="fas fa-eye-slash"></i></span>
      @endif

      {{ $grupo->nome }}
    </span>

    @includeWhen(Gate::allows('gerente'), 'livewire.partials.badge-grupo-sem-coluna')

    {{-- mostra com hover do mouse --}}
    <span class=" to-show">
      @includeWhen($gerenciar, 'livewire.partials.grupo-menu')
    </span>

    <div class="text-secondary">
      {{ $grupo->descricao }}
    </div>

  </div>
  <div class="card-body">
    @foreach ($grupo->itens as $item)
      @includeWhen($item->exibir || Gate::check('gerente'), 'livewire.partials.item')
    @endforeach
  </div>
</div>
