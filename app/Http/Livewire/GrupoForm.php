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
        'grupo.coluna' => 'required|integer', //colocar limites min e max
        'grupo.descricao' => 'nullable|string',
        'grupo.linha' => 'required|integer',
        'grupo.exibir' => 'required|boolean',
        'colunaArray' => '',
        'ordemArray' => '',
    ];

    protected $listeners = [
        'criarGrupo',
        'editarGrupo',
        'destruirGrupo',
    ];

    public function updatingGrupo($value, $key)
    {
        // se mudar a coluna, vamos atualizar as opções de linha
        if ($key == 'coluna') {
            $this->ordemArray = $this->grupo->ordemArray($value);
        }
    }

    public function criarGrupo()
    {
        Gate::allows('gerente');
        $this->grupo = new Grupo;
        $this->colunaArray = $this->grupo->colunaArray();
        $this->ordemArray = $this->grupo->ordemArray();
        $this->dispatchBrowserEvent('openGrupoModal', ['modalTitle'=>'Novo grupo']);
    }

    public function editarGrupo($grupoId)
    {
        Gate::allows('gerente');
        $this->grupo = Grupo::find($grupoId);
        $this->colunaArray = $this->grupo->colunaArray();
        $this->ordemArray = $this->grupo->ordemArray();
        $this->dispatchBrowserEvent('openGrupoModal', ['modalTitle'=>'Editar grupo']);
    }

    public function salvarGrupo() {
        Gate::allows('gerente');
        $this->grupo->save();
        $this->dispatchBrowserEvent('closeGrupoModal');
        $this->emitUp('refresh');
    }

    public function destruirGrupo($grupoId) {
        Gate::allows('gerente');
        Grupo::destroy($grupoId);
        $this->grupo = new Grupo; // inicializa as variaveis
        $this->emitUp('refresh');
    }

    public function mount()
    {
        $this->grupo = new Grupo;
        $this->colunaArray = $this->grupo->colunaArray();
        $this->ordemArray = []; // será carregado dinamicamente 
    }

    public function render()
    {
        return view('livewire.grupo-form');
    }
}
