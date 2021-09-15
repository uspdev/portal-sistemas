<span class="to-show ml-2">
  <button class="btn btn-sm btn-outline-primary py-0" wire:click="$emit('editarItem', {{ $item->id }})">
    <i class="fas fa-edit"></i>
  </button>
  <button class="btn btn-sm btn-outline-danger py-0" onclick="destruirItem({{ $item->id }})">
    <i class="fas fa-times text-danger"></i>
  </button>
</span>

@once
  @section('javascripts_bottom')
    @parent
    <script>
      function destruirItem(id) {
        console.log(id)
        if (confirm('Tem certeza?')) {
          Livewire.emit('destruirItem', id)
        }
      }
    </script>
  @endsection
@endonce