<div>
  <form>
    <div class="d-flex">
      <x-wire-input-text wire:model.lazy="item.nome" prepend="Nome" class="mr-auto" />
      <x-form-switch label="Exibir" wire:model="item.exibir" />
    </div>
    <x-wire-input-text wire:model.lazy="item.url" prepend="URL" class="mr-auto" />
    <x-form-textarea label="Descrição" wire:model="item.descricao" />

    <div class="d-flex flex-row">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary ml-2" wire:click.prevent="salvarItem">Salvar</button>
    </div>
  </form>
</div>
