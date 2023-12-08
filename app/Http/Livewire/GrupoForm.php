<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class GrupoForm extends Component
{

    public $grupo;
    public $colunaArray;
    public $ordemArray;

    protected $rules = [
        'grupo.nome' => 'required|string|max:100',
        'grupo.coluna' => 'required|integer|min:1', //colocar limites min e max
        'grupo.linha' => 'required|integer',
        'grupo.exibir' => 'required|boolean',
        'grupo.descricao' => 'nullable|string',
    ];

    protected $listeners = [
        'criarGrupo',
        'editarGrupo',
        'destruirGrupo',
    ];

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

    public function criarGrupo()
    {
        Gate::allows('manager');
        $this->mount();
        $this->dispatchBrowserEvent('openGrupoModal', ['modalTitle'=>'Novo grupo']);
    }

    public function editarGrupo($grupoId)
    {
        Gate::allows('manager');
        $this->grupo = Grupo::find($grupoId);
        $this->colunaArray = $this->grupo->colunaArray();
        $this->ordemArray = $this->grupo->ordemArray();
        $this->dispatchBrowserEvent('openGrupoModal', ['modalTitle'=>'Editar grupo']);
        $this->validate();
    }

    public function salvarGrupo() {
        Gate::allows('manager');
        $this->validate();

        $this->grupo->save();
        $this->dispatchBrowserEvent('closeGrupoModal');
        $this->mount();
        $this->emitUp('refresh');
    }

    public function destruirGrupo($grupoId) {
        Gate::allows('manager');
        Grupo::destroy($grupoId);
        $this->mount();
        $this->emitUp('refresh');
    }

    public function mount()
    {
        $this->grupo = new Grupo;
        $this->colunaArray = array_merge(['0'=>'?'],$this->grupo->colunaArray());
        $this->ordemArray = []; // será carregado dinamicamente
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.grupo-form');
    }
}
