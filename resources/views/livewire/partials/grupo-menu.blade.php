<button class="btn btn-sm btn-outline-warning d-inline-flex py-1" wire:click="$dispatch('editarGrupo', { grupoId: {{ $grupo->id }} })"
  title="Editar grupo">
  <i class="fas fa-pen"></i>
</button>

<button class="btn btn-sm btn-outline-danger d-inline-flex py-1" onclick="destruirGrupo({{ $grupo->id }})"
  title="Remover grupo">
  <i class="fas fa-times"></i>
</button>

<button class="btn btn-sm btn-outline-success d-inline-flex py-1" wire:click="$dispatch('criarItem', { grupo_id: {{ $grupo->id }} })"
  title="Criar item no grupo">
  <i class="fas fa-plus"></i>
</button>

@once
  @section('javascripts_bottom')
    @parent
    <script>
      function destruirGrupo(id) {
        // console.log(id)
        if (confirm('Tem certeza?')) {
          Livewire.dispatch('destruirGrupo', { grupoId: id })
        }
      }
    </script>
  @endsection
@endonce
