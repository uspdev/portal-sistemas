<?php

use App\Models\Grupo;
use App\Livewire\ShowGrupos;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemaController;
use Illuminate\Database\Eloquent\Collection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function(){
//     dd(Grupo::all() instanceof Collection);
//     foreach(Grupo::all()  as $grupo) {
//         echo $grupo->nome, '<br>';
//         dd($grupo instanceof Collection);
//     }
// });

Route::get('/', ShowGrupos::class);