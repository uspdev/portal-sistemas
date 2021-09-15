<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Models\Item;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class ShowGrupos extends Component
{
    public $grupos;
    public $itensSemGrupo;
    public $colunas;
    public $colunasPerdidas;

    protected $listeners = [
        'refresh',
    ];

    public function refresh()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->itensSemGrupo = Gate::allows('gerente') ? Item::whereNull('grupo_id')->get() : collect();
        $this->grupos = Grupo::all();

        $this->colunas = range(1, config('portal-sistemas.num_cols'));
        $this->colunasPerdidas = (config('portal-sistemas.num_cols') < 4) ? range(config('portal-sistemas.num_cols') + 1, 4) : [];
    }

    public function render()
    {
        return view('livewire.show-grupos')->extends('layouts.app')->section('content');
    }
}