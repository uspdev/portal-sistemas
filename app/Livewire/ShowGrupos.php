<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Grupo;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class ShowGrupos extends Component
{
    public $grupos;
    public $itensSemGrupo;
    public $colunas;
    public $colunasPerdidas;
    public $gerenciar;

    #[Locked]
    public bool $isManager = false;

    public function updateItensOrder($order)
    {
   //    dd($order);
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->itensSemGrupo = $this->isManager ? Item::whereNull('grupo_id')->get() : collect();
        $this->grupos = Grupo::all();
    }

    public function menuDinamico()
    {
        if ($this->isManager && $this->gerenciar == 0) {
            \UspTheme::addMenu('portal-sistemas', [
                'text' => '<button class="btn btn-danger btn-sm">Habilitar edição</button>',
                'url' => '?gerenciar=1',
            ]);
        }
        if ($this->isManager && $this->gerenciar == 1) {
            \UspTheme::addMenu('portal-sistemas', [
                [
                    'text' => '<button class="btn btn-success btn-sm">Finalizar edição</button>',
                    'url' => '?gerenciar=0',
                ],
                [
                    'text' => '<button class="btn btn-sm btn-primary" onclick="Livewire.dispatch(\'criarGrupo\')">Novo Grupo</button>',
                ],
                // [
                //     'text' => '<button class="btn btn-sm btn-warning" onclick="window.livewire.dispatch(\'criarItem\')">Novo Item de grupo</button>',
                // ]
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

        $this->isManager = Gate::check('manager');

        $this->gerenciar($request);
        $this->menuDinamico();

        $this->itensSemGrupo = $this->isManager ? Item::whereNull('grupo_id')->get() : collect();
        $this->grupos = Grupo::all();

        $this->colunas = range(1, config('portal-sistemas.num_cols'));
        $this->colunasPerdidas = (config('portal-sistemas.num_cols') < 4) ? range(config('portal-sistemas.num_cols') + 1, 4) : [];
    }

    public function render()
    {
        return view('livewire.show-grupos')->extends('layouts.app')->section('content');
    }
}
