<div>

  @can('gerente')
    <button class="btn btn-primary mb-3" wire:click="$emit('criarGrupo')">Novo Grupo</button>
    <button class="btn btn-warning mb-3" wire:click="$emit('criarItem')">Novo Item de grupo</button>
  @endcan

  {{-- Grupos e itens --}}
  <div class="row">
    @foreach ($colunas as $col)
      <div class="col-md-{{ config('portal-sistemas.col_width') }}">
        @include('livewire.partials.grupos-coluna')
      </div>
    @endforeach
  </div>

  {{-- Grupos sem colunas --}}
  <div class="row">
    @foreach ($colunasPerdidas as $col)
      <div class="col-md-12">
        @include('livewire.partials.grupos-coluna')
      </div>
    @endforeach
  </div>

  @includeWhen(Gate::allows('gerente') && $sistemasSemGrupo->isNotEmpty(), 'livewire.partials.sistemas-sem-grupo')

  <!-- Modal de grupo -->
  <div class="modal" tabindex="-1" id="modalGrupo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ $modalTitle ?? ''}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @livewire('grupo-form')
        </div>
      </div>
    </div>
  </div>

  @section('javascripts_bottom')
    @parent
    <script>
      window.addEventListener('openGrupoModal', event => {
        $('#modalGrupo').modal('show')
      })

      window.addEventListener('closeGrupoModal', event => {
        $('#modalGrupo').modal('hide')
      })
    </script>
  @endsection

</div>
