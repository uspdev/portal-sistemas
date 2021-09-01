<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemaController;

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

Route::get('/', function () {
    $sistemas = \App\Models\Sistema::all();
    $grupos = \App\Models\Grupo::all();
    return view('welcome', compact('sistemas', 'grupos'));
});

Route::resource('sistemas', SistemaController::class);
