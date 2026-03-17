<?php

namespace App\Livewire;

use App\Models\Grupo;
use App\Models\Item;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Locked;

class ItemForm extends Component
{

    public $item;
    public $gruposSelect;

    #[Locked]
    public bool $isManager = false;

    protected $rules = [
        'item.nome' => 'required',
        'item.url' => 'nullable|url',
        'item.descricao' => 'nullable|string',
        'item.exibir' => 'required|boolean',
        'item.grupo_id' => ['required', 'exists:grupos,id'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    #[On('criarItem')]
    public function criarItem($grupo_id = null)
    {
        abort_if(!$this->isManager, 403, 'Acesso Negado');
        $this->limparFormulario();
        $this->item->grupo_id = $grupo_id;
        $this->dispatch('openItemModal', modalTitle:'Novo item');
    }

    #[On('editarItem')]
    public function editarItem($itemId)
    {
        abort_if(!$this->isManager, 403, 'Acesso Negado');
        $this->item = Item::find($itemId);
        $this->gruposSelect = Grupo::pluck('nome', 'id');
        $this->dispatch('openItemModal', modalTitle: 'Editar item');
        $this->validate();
    }

    public function salvarItem()
    {
        abort_if(!$this->isManager, 403, 'Acesso Negado');
        $this->validate();
        $this->item->save();
        $this->dispatch('closeItemModal');
        $this->limparFormulario();
        $this->dispatch('refresh')->to(ShowGrupos::class);
    }

    #[On('destruirItem')]
    public function destruirItem($itemId)
    {
        abort_if(!$this->isManager, 403, 'Acesso Negado');
        Item::destroy($itemId);
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
        $this->item = new Item;
        $this->gruposSelect = Grupo::pluck('nome', 'id')->prepend('Selecione um..', 0);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.item-form');
    }

    
}
