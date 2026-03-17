<?php

namespace App\Livewire;

use App\Models\Grupo;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class GrupoForm extends Component
{

    public $grupo;
    public $colunaArray;
    public $ordemArray;

    #[Locked]
    public bool $isManager = false;

    public function rules()
    {   

        $colunasValidas = implode(',', array_keys($this->colunaArray));

        return [
            'grupo.nome' => 'required|string|max:100',
            'grupo.coluna' => "required|integer|min:1|in:{$colunasValidas}",
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
        abort_if(!$this->isManager, 403, 'Acesso Negado');
        $this->limparFormulario();
        $this->dispatch('openGrupoModal', modalTitle: 'Novo grupo');
    }

    #[On('editarGrupo')]
    public function editarGrupo($grupoId)
    {
        abort_if(!$this->isManager, 403, 'Acesso Negado');
        $this->grupo = Grupo::find($grupoId);
        $this->colunaArray = Grupo::colunaArray($this->grupo->coluna);
        $this->ordemArray = $this->grupo->ordemArray();
        $this->dispatch('openGrupoModal', modalTitle: 'Editar grupo');
        $this->resetValidation();
    }

    public function salvarGrupo() {
        abort_if(!$this->isManager, 403, 'Acesso Negado');

        $this->validate();
        $this->grupo->save();

        $this->dispatch('closeGrupoModal');
        $this->limparFormulario();
        $this->dispatch('refresh')->to(ShowGrupos::class);
    }

    #[On('destruirGrupo')]
    public function destruirGrupo($grupoId) {
        abort_if(!$this->isManager, 403, 'Acesso Negado');
        Grupo::destroy($grupoId);
        $this->limparFormulario();
        $this->dispatch('refresh')->to(ShowGrupos::class);
    }

    public function mount()
    {
        $this->isManager = Gate::check('manager');
        $this->limparFormulario();
    }

    public function limparFormulario()
    {
        $this->grupo = new Grupo;
        $this->colunaArray = Grupo::colunaArray();
        $this->ordemArray = []; 
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.grupo-form');
    }
}
