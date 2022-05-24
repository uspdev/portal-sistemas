<div>
  <form>
    <div class="d-flex">
      <x-wire-input-text model="grupo.nome" prepend="Nome" class="mr-auto" />
      <x-wire-select prepend="COL" :options="$colunaArray" model="grupo.coluna" />
      <x-wire-select prepend="LIN" :options="$ordemArray" model="grupo.linha" />
      <x-wire-switch label="Exibir" model="grupo.exibir" />
    </div>
    <x-wire-textarea label="Descrição" model="grupo.descricao" />

    <div class="d-flex flex-row">
      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-sm btn-primary ml-2" wire:click.prevent="salvarGrupo">Salvar</button>
    </div>
  </form>
</div>
