<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Models\Item;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class ItemForm extends Component
{

    public $item;
    public $gruposSelect;

    protected $rules = [
        'item.nome' => 'required',
        'item.url' => 'nullable|url',
        'item.descricao' => 'nullable|string',
        'item.exibir' => 'required|boolean',
        'item.grupo_id' => 'required|integer',
    ];

    protected $listeners = [
        'criarItem',
        'editarItem',
        'destruirItem',
    ];

    public function criarItem()
    {
        Gate::allows('gerente');
        $this->item = new Item;
        $this->dispatchBrowserEvent('openItemModal', ['modalTitle'=>'Novo item']);
    }

    public function editarItem($itemId)
    {
        Gate::allows('gerente');
        $this->item = Item::find($itemId);
        $this->gruposSelect = Grupo::pluck('nome', 'id');
        $this->dispatchBrowserEvent('openItemModal', ['modalTitle'=>'Editar item']);
    }

    public function salvarItem() {
        Gate::allows('gerente');
        $this->item->save();
        $this->dispatchBrowserEvent('closeItemModal');
        $this->emitUp('refresh');
    }

    public function destruirItem($itemId) {
        Gate::allows('gerente');
        Item::destroy($itemId);
        $this->mount(); // inicializa as variaveis
        $this->emitUp('refresh');
    }

    public function mount()
    {
        $this->item = new Item;
        $this->gruposSelect = Grupo::pluck('nome', 'id');;
    }

    public function render()
    {
        return view('livewire.item-form');
    }
}
