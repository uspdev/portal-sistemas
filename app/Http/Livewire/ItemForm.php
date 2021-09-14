<?php

namespace App\Http\Livewire;

use App\Models\Sistema;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class ItemForm extends Component
{

    public $item;

    protected $rules = [
        'item.nome' => 'required',
        'item.url' => 'nullable|url',
        'item.descricao' => 'nullable|string',
        'item.exibir' => 'required|boolean',
    ];

    protected $listeners = [
        'criarItem',
        'editarItem',
        'destruirItem',
    ];

    public function criarItem()
    {
        Gate::allows('gerente');
        $this->item = new Sistema;
        $this->dispatchBrowserEvent('openItemModal', ['modalTitle'=>'Novo item']);
    }

    public function editarItem($itemId)
    {
        Gate::allows('gerente');
        $this->item = Sistema::find($itemId);
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
        Sistema::destroy($itemId);
        $this->item = new Sistema; // inicializa as variaveis
        $this->emitUp('refresh');
    }

    public function mount()
    {
        $this->item = new Sistema;
    }

    public function render()
    {
        return view('livewire.item-form');
    }
}
