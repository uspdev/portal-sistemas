<div>
  <form>
    <div class="d-flex">
      <x-wire-input-text wire:model.lazy="grupo.nome" prepend="Nome" class="mr-auto" />
      <x-form-select prepend="COL" :options="$colunaArray" wire:model="grupo.coluna">
        <option value="">?</option>
      </x-form-select>
      <x-form-select prepend="LIN" :options="$ordemArray" wire:model="grupo.linha" />
      <x-form-switch label="Exibir" wire:model="grupo.exibir" />
    </div>
    <x-form-textarea label="Descrição" wire:model="grupo.descricao" />

    <div class="d-flex flex-row">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary ml-2" wire:click.prevent="salvarGrupo">Salvar</button>
    </div>
  </form>
</div>
