<div>

  @if($gerenciar)
    <button class="btn btn-primary mb-3" wire:click="$emit('criarGrupo')">Novo Grupo</button>
    <button class="btn btn-warning mb-3" wire:click="$emit('criarItem')">Novo Item de grupo</button>
  @endcan



  {{-- Grupos regulares --}}
  <div class="row">
    @foreach ($colunas as $col)
      <div class="col-md-{{ config('portal-sistemas.col_width') }}">

        {{-- Mostra os grupos de uma mesma coluna --}}
        @foreach ($grupos->where('coluna', $col)->sortBy('linha') as $grupo)
          @if ($grupo->exibir || Gate::check('gerente'))
            @include('livewire.partials.grupo-card')
          @endif
        @endforeach

      </div>
    @endforeach
  </div>

  {{-- Grupos sem colunas --}}
  <div class="row">
    @foreach ($colunasPerdidas as $col)
      <div class="col-md-12">

        @foreach ($grupos->where('coluna', $col)->sortBy('linha') as $grupo)
          @include('livewire.partials.grupo-card')
        @endforeach
        
      </div>
    @endforeach
  </div>

  {{-- Itens sem grupo --}}
  @includeWhen(Gate::allows('gerente') && $itensSemGrupo->isNotEmpty(), 'livewire.partials.itens-sem-grupo')

  <!-- Modal de grupo -->
  <div class="modal" tabindex="-1" id="modalGrupo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Novo/editar grupo</h5>
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

  <!-- Modal de item -->
  <div class="modal" tabindex="-1" id="modalItem">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Novo/editar item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @livewire('item-form')
        </div>
      </div>
    </div>
  </div>

  @section('javascripts_bottom')
    @parent
    <script>
      window.addEventListener('openGrupoModal', event => {
        $('#modalGrupo').find('.modal-title').html(event.detail.modalTitle)
        $('#modalGrupo').modal('show')
      })

      window.addEventListener('closeGrupoModal', event => {
        $('#modalGrupo').modal('hide')
      })

      window.addEventListener('openItemModal', event => {
        $('#modalItem').find('.modal-title').html(event.detail.modalTitle)
        $('#modalItem').modal('show')
      })

      window.addEventListener('closeItemModal', event => {
        $('#modalItem').modal('hide')
      })
    </script>
  @endsection

</div>
