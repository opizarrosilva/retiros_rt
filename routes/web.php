<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RetiroController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LlamadoController;
use App\Http\Controllers\AtributoController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EstadoretiroController;
use App\Http\Controllers\EstadoagendaController;
use App\Http\Controllers\BloquehorarioController;
use App\Http\Controllers\TipoevidenciaController;
use App\Http\Controllers\ModificacioneController;
use App\Http\Controllers\EstadollamadoController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('estadoretiros', EstadoretiroController::class);
        Route::resource('bloquehorarios', BloquehorarioController::class);
        Route::resource('atributos', AtributoController::class);
        Route::resource('tipoevidencias', TipoevidenciaController::class);
        Route::resource('clientes', ClienteController::class);
        Route::resource('bitacoras', BitacoraController::class);
        Route::resource('modificaciones', ModificacioneController::class);
        Route::resource('retiros', RetiroController::class);
        Route::resource('evidencias', EvidenciaController::class);
        Route::resource('agendas', AgendaController::class);
        Route::get('estadoagendas', [
            EstadoagendaController::class,
            'index',
        ])->name('estadoagendas.index');
        Route::post('estadoagendas', [
            EstadoagendaController::class,
            'store',
        ])->name('estadoagendas.store');
        Route::get('estadoagendas/create', [
            EstadoagendaController::class,
            'create',
        ])->name('estadoagendas.create');
        Route::get('estadoagendas/{estadoagenda}', [
            EstadoagendaController::class,
            'show',
        ])->name('estadoagendas.show');
        Route::get('estadoagendas/{estadoagenda}/edit', [
            EstadoagendaController::class,
            'edit',
        ])->name('estadoagendas.edit');
        Route::put('estadoagendas/{estadoagenda}', [
            EstadoagendaController::class,
            'update',
        ])->name('estadoagendas.update');
        Route::delete('estadoagendas/{estadoagenda}', [
            EstadoagendaController::class,
            'destroy',
        ])->name('estadoagendas.destroy');

        Route::resource('users', UserController::class);
        Route::resource('estadollamados', EstadollamadoController::class);
        Route::resource('llamados', LlamadoController::class);
    });
