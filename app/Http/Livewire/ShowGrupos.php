<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Models\Sistema;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class ShowGrupos extends Component
{
    public $grupos;
    public $sistemasOrfaos;
    public $modalTitle = 'Adicionar/editar grupo';

    protected $listeners = [
        'setModalTitle',
        'refresh',
    ];

    public function refresh()
    {
        $this->grupos = Grupo::all();
    }

    public function setModalTitle($title)
    {
        $this->modalTitle = $title;
    }

    public function mount()
    {
        $this->sistemasOrfaos = Gate::allows('gerente') ? Sistema::doesntHave('grupos')->get() : [];
        $this->grupos = Grupo::all();
    }

    public function render()
    {
        return view('livewire.show-grupos')->extends('layouts.app')->section('content');
    }
}