<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\RetiroController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\LlamadoController;
use App\Http\Controllers\Api\AtributoController;
use App\Http\Controllers\Api\BitacoraController;
use App\Http\Controllers\Api\EvidenciaController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserRetirosController;
use App\Http\Controllers\Api\UserAgendasController;
use App\Http\Controllers\Api\EstadoretiroController;
use App\Http\Controllers\Api\EstadoagendaController;
use App\Http\Controllers\Api\UserLlamadosController;
use App\Http\Controllers\Api\BloquehorarioController;
use App\Http\Controllers\Api\TipoevidenciaController;
use App\Http\Controllers\Api\ModificacioneController;
use App\Http\Controllers\Api\RetiroAgendasController;
use App\Http\Controllers\Api\UserBitacorasController;
use App\Http\Controllers\Api\EstadollamadoController;
use App\Http\Controllers\Api\ClienteRetirosController;
use App\Http\Controllers\Api\RetiroLlamadosController;
use App\Http\Controllers\Api\UserEvidenciasController;
use App\Http\Controllers\Api\RetiroBitacorasController;
use App\Http\Controllers\Api\RetiroEvidenciasController;
use App\Http\Controllers\Api\UserModificacionesController;
use App\Http\Controllers\Api\EstadoretiroRetirosController;
use App\Http\Controllers\Api\EstadoagendaAgendasController;
use App\Http\Controllers\Api\BloquehorarioAgendasController;
use App\Http\Controllers\Api\RetiroModificacionesController;
use App\Http\Controllers\Api\EstadollamadoLlamadosController;
use App\Http\Controllers\Api\AtributoModificacionesController;
use App\Http\Controllers\Api\TipoevidenciaEvidenciasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('estadoretiros', EstadoretiroController::class);

        // Estadoretiro Retiros
        Route::get('/estadoretiros/{estadoretiro}/retiros', [
            EstadoretiroRetirosController::class,
            'index',
        ])->name('estadoretiros.retiros.index');
        Route::post('/estadoretiros/{estadoretiro}/retiros', [
            EstadoretiroRetirosController::class,
            'store',
        ])->name('estadoretiros.retiros.store');

        Route::apiResource('bloquehorarios', BloquehorarioController::class);

        // Bloquehorario Agendas
        Route::get('/bloquehorarios/{bloquehorario}/agendas', [
            BloquehorarioAgendasController::class,
            'index',
        ])->name('bloquehorarios.agendas.index');
        Route::post('/bloquehorarios/{bloquehorario}/agendas', [
            BloquehorarioAgendasController::class,
            'store',
        ])->name('bloquehorarios.agendas.store');

        Route::apiResource('atributos', AtributoController::class);

        // Atributo Modificaciones
        Route::get('/atributos/{atributo}/modificaciones', [
            AtributoModificacionesController::class,
            'index',
        ])->name('atributos.modificaciones.index');
        Route::post('/atributos/{atributo}/modificaciones', [
            AtributoModificacionesController::class,
            'store',
        ])->name('atributos.modificaciones.store');

        Route::apiResource('tipoevidencias', TipoevidenciaController::class);

        // Tipoevidencia Evidencias
        Route::get('/tipoevidencias/{tipoevidencia}/evidencias', [
            TipoevidenciaEvidenciasController::class,
            'index',
        ])->name('tipoevidencias.evidencias.index');
        Route::post('/tipoevidencias/{tipoevidencia}/evidencias', [
            TipoevidenciaEvidenciasController::class,
            'store',
        ])->name('tipoevidencias.evidencias.store');

        Route::apiResource('clientes', ClienteController::class);

        // Cliente Retiros
        Route::get('/clientes/{cliente}/retiros', [
            ClienteRetirosController::class,
            'index',
        ])->name('clientes.retiros.index');
        Route::post('/clientes/{cliente}/retiros', [
            ClienteRetirosController::class,
            'store',
        ])->name('clientes.retiros.store');

        Route::apiResource('bitacoras', BitacoraController::class);

        Route::apiResource('modificaciones', ModificacioneController::class);

        Route::apiResource('retiros', RetiroController::class);

        // Retiro Bitacoras
        Route::get('/retiros/{retiro}/bitacoras', [
            RetiroBitacorasController::class,
            'index',
        ])->name('retiros.bitacoras.index');
        Route::post('/retiros/{retiro}/bitacoras', [
            RetiroBitacorasController::class,
            'store',
        ])->name('retiros.bitacoras.store');

        // Retiro Modificaciones
        Route::get('/retiros/{retiro}/modificaciones', [
            RetiroModificacionesController::class,
            'index',
        ])->name('retiros.modificaciones.index');
        Route::post('/retiros/{retiro}/modificaciones', [
            RetiroModificacionesController::class,
            'store',
        ])->name('retiros.modificaciones.store');

        // Retiro Agendas
        Route::get('/retiros/{retiro}/agendas', [
            RetiroAgendasController::class,
            'index',
        ])->name('retiros.agendas.index');
        Route::post('/retiros/{retiro}/agendas', [
            RetiroAgendasController::class,
            'store',
        ])->name('retiros.agendas.store');

        // Retiro Evidencias
        Route::get('/retiros/{retiro}/evidencias', [
            RetiroEvidenciasController::class,
            'index',
        ])->name('retiros.evidencias.index');
        Route::post('/retiros/{retiro}/evidencias', [
            RetiroEvidenciasController::class,
            'store',
        ])->name('retiros.evidencias.store');

        // Retiro Llamados
        Route::get('/retiros/{retiro}/llamados', [
            RetiroLlamadosController::class,
            'index',
        ])->name('retiros.llamados.index');
        Route::post('/retiros/{retiro}/llamados', [
            RetiroLlamadosController::class,
            'store',
        ])->name('retiros.llamados.store');

        Route::apiResource('evidencias', EvidenciaController::class);

        Route::apiResource('agendas', AgendaController::class);

        Route::apiResource('modificaciones', ModificacioneController::class);

        Route::apiResource('agendas', AgendaController::class);

        Route::apiResource('evidencias', EvidenciaController::class);

        Route::apiResource('estadoagendas', EstadoagendaController::class);

        // Estadoagenda Agendas
        Route::get('/estadoagendas/{estadoagenda}/agendas', [
            EstadoagendaAgendasController::class,
            'index',
        ])->name('estadoagendas.agendas.index');
        Route::post('/estadoagendas/{estadoagenda}/agendas', [
            EstadoagendaAgendasController::class,
            'store',
        ])->name('estadoagendas.agendas.store');

        Route::apiResource('users', UserController::class);

        // User Retiros
        Route::get('/users/{user}/retiros', [
            UserRetirosController::class,
            'index',
        ])->name('users.retiros.index');
        Route::post('/users/{user}/retiros', [
            UserRetirosController::class,
            'store',
        ])->name('users.retiros.store');

        // User Bitacoras
        Route::get('/users/{user}/bitacoras', [
            UserBitacorasController::class,
            'index',
        ])->name('users.bitacoras.index');
        Route::post('/users/{user}/bitacoras', [
            UserBitacorasController::class,
            'store',
        ])->name('users.bitacoras.store');

        // User Modificaciones
        Route::get('/users/{user}/modificaciones', [
            UserModificacionesController::class,
            'index',
        ])->name('users.modificaciones.index');
        Route::post('/users/{user}/modificaciones', [
            UserModificacionesController::class,
            'store',
        ])->name('users.modificaciones.store');

        // User Agendas
        Route::get('/users/{user}/agendas', [
            UserAgendasController::class,
            'index',
        ])->name('users.agendas.index');
        Route::post('/users/{user}/agendas', [
            UserAgendasController::class,
            'store',
        ])->name('users.agendas.store');

        // User Evidencias
        Route::get('/users/{user}/evidencias', [
            UserEvidenciasController::class,
            'index',
        ])->name('users.evidencias.index');
        Route::post('/users/{user}/evidencias', [
            UserEvidenciasController::class,
            'store',
        ])->name('users.evidencias.store');

        // User Llamados
        Route::get('/users/{user}/llamados', [
            UserLlamadosController::class,
            'index',
        ])->name('users.llamados.index');
        Route::post('/users/{user}/llamados', [
            UserLlamadosController::class,
            'store',
        ])->name('users.llamados.store');

        Route::apiResource('estadollamados', EstadollamadoController::class);

        // Estadollamado Llamados
        Route::get('/estadollamados/{estadollamado}/llamados', [
            EstadollamadoLlamadosController::class,
            'index',
        ])->name('estadollamados.llamados.index');
        Route::post('/estadollamados/{estadollamado}/llamados', [
            EstadollamadoLlamadosController::class,
            'store',
        ])->name('estadollamados.llamados.store');

        Route::apiResource('llamados', LlamadoController::class);

        Route::apiResource('llamados', LlamadoController::class);
    });
