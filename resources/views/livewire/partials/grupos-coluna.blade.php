{{-- Mostra os grupos de uma mesma coluna --}}

@foreach ($grupos->where('coluna', $col)->sortBy('linha') as $grupo)
  @if ($grupo->exibir || Gate::check('gerente'))
    <div class="card mb-3">
      <div class="card-header to-hover py-2">
        <span class="h4">
          @include('livewire.partials.grupo-nome')
        </span>
        @includeWhen(Gate::allows('gerente'), 'livewire.partials.badge-grupo-sem-coluna')

        {{-- mostra com hover do mouse --}}
        <span class="to-show">
          @includeWhen(Gate::allows('gerente'), 'livewire.partials.grupo-edit')
          @includeWhen(Gate::allows('gerente'), 'livewire.partials.grupo-destroy')
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
  @endif
@endforeach
