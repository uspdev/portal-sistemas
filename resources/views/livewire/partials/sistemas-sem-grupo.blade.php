<div class="row">
  <div class="col-md-12">
    <div class="card mb-3">
      <div class="card-header">
        <span class="h4 text-danger" title="Não aparecem no portal">
          <span class="badge text-warning"><i class="fas fa-eye-slash"></i></span>
          Sistemas sem grupo
        </span>
      </div>
      <div class="card-body">
        @foreach ($sistemasSemGrupo as $sistema)
          @include('livewire.partials.sistema')
        @endforeach
      </div>
    </div>
  </div>
</div>
