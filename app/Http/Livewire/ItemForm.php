<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Models\Item;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ItemForm extends Component
{

    public $item;
    public $gruposSelect;

    protected $rules = [
        'item.nome' => 'required',
        'item.url' => 'nullable|url',
        'item.descricao' => 'nullable|string',
        'item.exibir' => 'required|boolean',
        'item.grupo_id' => ['required', 'exists:grupos,id'],
    ];

    protected $listeners = [
        'criarItem',
        'editarItem',
        'destruirItem',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function criarItem($grupo_id = null)
    {
        Gate::allows('manager');
        $this->mount();
        $this->item->grupo_id = $grupo_id;
        $this->dispatchBrowserEvent('openItemModal', ['modalTitle' => 'Novo item']);
    }

    public function editarItem($itemId)
    {
        Gate::allows('manager');
        $this->item = Item::find($itemId);
        $this->gruposSelect = Grupo::pluck('nome', 'id');
        $this->dispatchBrowserEvent('openItemModal', ['modalTitle' => 'Editar item']);
        $this->validate();
    }

    public function salvarItem()
    {
        Gate::allows('manager');
        $this->validate();
        $this->item->save();
        $this->dispatchBrowserEvent('closeItemModal');
        $this->mount();
        $this->emitUp('refresh');
    }

    public function destruirItem($itemId)
    {
        Gate::allows('manager');
        Item::destroy($itemId);
        $this->mount(); // inicializa as variaveis
        $this->emitUp('refresh');
    }

    public function mount()
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
