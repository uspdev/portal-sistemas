{{-- Mostra os grupos de uma mesma coluna --}}

@foreach ($grupos->where('coluna', $col)->sortBy('linha') as $grupo)
  @if ($grupo->exibir || Gate::check('gerente'))
    <div class="card mb-3">
      <div class="card-header to-hover">
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
        @can('gerente')
          <a href class="text-warning mb-3" wire:click.prevent="$emit('criarSistema')">
            <i class="fas fa-plus"></i> Adicionar item
          </a>
        @endcan

        @foreach ($grupo->sistemas as $sistema)
          @include('livewire.partials.sistema')
        @endforeach
      </div>
    </div>
  @endif
@endforeach
