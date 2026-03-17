<div>
    <form wire:submit.prevent="salvarGrupo">
        <div class="d-flex align-items-center mb-3">

            <div class="flex-grow-1 mr-3">
                <x-wire-input-text model="grupo.nome" prepend="Nome" />
            </div>

            <div class="mr-3 flex-shrink-0" wire:key="select-coluna-{{ $grupo->id ?? 'novo' }}">
                <x-wire-select prepend="COL" :options="$colunaArray" model="grupo.coluna" />
            </div>

            <div class="mr-3 flex-shrink-0" wire:key="select-linha-{{ $grupo->id ?? 'novo' }}">
                <x-wire-select prepend="LIN" :options="$ordemArray" model="grupo.linha" />
            </div>

            <div class="flex-shrink-0">
                <x-wire-switch label="Exibir" model="grupo.exibir" />
            </div>

        </div>

        <x-wire-textarea label="Descrição" model="grupo.descricao" />

        <div class="d-flex flex-row mt-3">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-sm btn-primary ml-2">Salvar</button>
        </div>
    </form>
</div>
