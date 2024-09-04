<?php

namespace App\Livewire;

use App\Models\Grupo;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;

class GrupoForm extends Component
{

    public $grupo;
    public $colunaArray;
    public $ordemArray;

    public function rules()
    {
        return [
            'grupo.nome' => 'required|string|max:100',
            'grupo.coluna' => 'required|integer|min:1', //colocar limites min e max
            'grupo.linha' => 'required|integer',
            'grupo.exibir' => 'required|boolean',
            'grupo.descricao' => 'nullable|string',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingGrupo($value, $key)
    {
        // se mudar a coluna, vamos atualizar as opções de linha
        if ($key == 'coluna') {
            $this->grupo->linha = !$this->grupo->linha ?: 1;
            $this->ordemArray = $this->grupo->ordemArray($value);
        }
    }

    #[On('criarGrupo')]
    public function criarGrupo()
    {
        Gate::allows('manager');
        $this->mount();
        $this->dispatch('openGrupoModal', modalTitle: 'Novo grupo');
    }

    #[On('editarGrupo')]
    public function editarGrupo($grupoId)
    {
        Gate::allows('manager');
        $this->grupo = Grupo::find($grupoId);
        $this->colunaArray = $this->grupo->colunaArray();
        $this->ordemArray = $this->grupo->ordemArray();
        $this->dispatch('openGrupoModal', modalTitle: 'Editar grupo');
        $this->validate();
    }

    public function salvarGrupo() {
        Gate::allows('manager');

        $this->validate();
        $this->grupo->save();

        $this->dispatch('closeGrupoModal');
        $this->mount();
        $this->dispatch('refresh')->to(ShowGrupos::class);
    }

    #[On('destruirGrupo')]
    public function destruirGrupo($grupoId) {
        Gate::allows('manager');
        Grupo::destroy($grupoId);
        $this->mount();
        $this->dispatch('refresh')->to(ShowGrupos::class);
    }

    public function mount()
    {
        $this->grupo = new Grupo;
        $this->colunaArray = array_merge(['0'=>'?'],$this->grupo->colunaArray());
        $this->ordemArray = []; // será carregado dinamicamente
    }

    public function render()
    {
        return view('livewire.grupo-form');
    }
}
