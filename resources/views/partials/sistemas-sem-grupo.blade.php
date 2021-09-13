<div class="row">
  <div class="col-md-12">
    <div class="card mb-3">
      <div class="card-header">
        <span class="h4 text-danger">Sistemas sem grupo</span>
        <span class="badge badge-danger">Não aparecem no portal</span>
      </div>
      <div class="card-body">
        @foreach ($sistemasOrfaos as $sistema)
          @include('partials.sistema')
        @endforeach
      </div>
    </div>
  </div>
</div>
