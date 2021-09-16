<button class="btn btn-outline-warning d-inline-flex py-1" wire:click="$emit('editarGrupo', {{ $grupo->id }})">
  <i class="fas fa-pen"></i>
</button>

<button class="btn btn-outline-danger d-inline-flex py-1" onclick="destruirGrupo({{ $grupo->id }})">
  <i class="fas fa-times"></i>
</button>

@once
  @section('javascripts_bottom')
    @parent
    <script>
      function destruirGrupo(id) {
        console.log(id)
        if (confirm('Tem certeza?')) {
          Livewire.emit('destruirGrupo', id)
        }
      }
    </script>
  @endsection
@endonce
