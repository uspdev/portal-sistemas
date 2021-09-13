<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Models\Sistema;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class ShowGrupos extends Component
{
    public $grupos;
    public $sistemasSemGrupo;
    public $modalTitle = 'Adicionar/editar grupo';

    protected $listeners = [
        'setModalTitle',
        'refresh',
    ];

    public function refresh()
    {
        $this->mount();
    }

    public function setModalTitle($title)
    {
        $this->modalTitle = $title;
    }

    public function mount()
    {
        $this->sistemasSemGrupo = Gate::allows('gerente') ? Sistema::doesntHave('grupos')->get() : collect();
        $this->grupos = Grupo::all();
    }

    public function render()
    {
        return view('livewire.show-grupos')->extends('layouts.app')->section('content');
    }
}