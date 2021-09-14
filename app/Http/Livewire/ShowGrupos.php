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
        $this->sistemasSemGrupo = Gate::allows('gerente') ? Sistema::doesntHave('grupos')->get() : collect();
        $this->grupos = Grupo::all();

        $this->colunas = range(1, config('portal-sistemas.num_cols'));
        $this->colunasPerdidas = (config('portal-sistemas.num_cols') < 4) ? range(config('portal-sistemas.num_cols') + 1, 4) : [];
    }

    public function render()
    {
        return view('livewire.show-grupos')->extends('layouts.app')->section('content');
    }
}