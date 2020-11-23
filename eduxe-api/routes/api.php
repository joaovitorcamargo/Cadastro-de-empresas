<?php

use App\Http\Controllers\EmpresaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::get('listar-empresas', 'EmpresaController@listarEmpresa');
    Route::get('listar-unidades', 'UnidadeController@listarUnidades');
    Route::post('cadastra-empresa', 'EmpresaController@cadastraEmpresa');
    Route::post('mostrar-empresa', 'EmpresaController@mostrarEmpresa');
    Route::post('mostrar-unidade', 'UnidadeController@mostrarUnidade');
    Route::post('editar-empresa', 'EmpresaController@editarEmpresa');
    Route::post('editar-unidade', 'UnidadeController@editarUnidade');
    Route::post('deletar-empresa', 'EmpresaController@deletarEmpresa');
    Route::post('deletar-unidade', 'UnidadeController@deletarUnidade');
    Route::post('cadastra-unidade', 'UnidadeController@cadastraUnidade');
});
