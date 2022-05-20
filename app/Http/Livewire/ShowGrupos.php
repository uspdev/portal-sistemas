<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Grupo;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ShowGrupos extends Component
{
    public $grupos;
    public $itensSemGrupo;
    public $colunas;
    public $colunasPerdidas;
    public $gerenciar;

    protected $listeners = [
        'refresh',
    ];

    public function refresh()
    {
        $this->mount();
    }

    public function menuDinamico()
    {
        if (Gate::allows('gerente') && $this->gerenciar == 0) {
            \UspTheme::addMenu('portal-sistemas', [
                'text' => '<button class="btn btn-danger btn-sm">Habilitar edição</button>',
                'url' => '?gerenciar=1',
                'can' => 'gerente'
            ]);
        }
        if (Gate::allows('gerente') && $this->gerenciar == 1) {
            \UspTheme::addMenu('portal-sistemas', [
                'text' => '<button class="btn btn-success btn-sm">Finalizar edição</button>',
                'url' => '?gerenciar=0',
                'can' => 'gerente'
            ]);
        }
    }

    public function gerenciar($request)
    {
        if (isset($request->gerenciar)) {
            $gerenciar = ($request->gerenciar == 1) ? 1 : 0;
            session(['portal-sistemas.gerenciar' => $gerenciar]);
            return redirect()->to('/');
        }
        $this->gerenciar = session('portal-sistemas.gerenciar', 0);
    }

    public function mount(Request $request = null)
    {
        $this->gerenciar($request);
        $this->menuDinamico();

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
