<button class="btn btn-outline-danger d-inline-flex destruirGrupo" onclick="confirme({{ $grupo->id }})">
  <i class="fas fa-times"></i>
</button>

@once
  @section('javascripts_bottom')
    @parent
    <script>
      function confirme(id) {
        console.log(id)
        if (confirm('Tem certeza?')) {
          Livewire.emit('destruirGrupo', id)
        }
      }
    </script>
  @endsection
@endonce
