<?php

use App\Http\Controllers\API\IndicadorApiController;
use App\Http\Controllers\API\ProjetoApiController;
use App\Http\Controllers\API\RegiaoAPIController;
use App\Http\Controllers\API\TipoRegiaoAPIController;
use App\Http\Controllers\API\ValorApiController;
use App\Http\Controllers\API\VariavelAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Projetos
Route::get('projetos', [ProjetoApiController::class, 'index']);

// Indicadores
Route::get('indicadores', [IndicadorApiController::class, 'index']);
Route::get('indicadores/{projeto_id}', [IndicadorApiController::class, 'show']);

// Valores
Route::get('valores', [ValorApiController::class, 'index']);
Route::get('variavel/{variavel_id}/valores', [ValorApiController::class, 'show']);

// Variaveis
Route::get('variavel', [VariavelAPIController::class, 'index']);
Route::get('indicador/{indicador_id}/variavel', [VariavelAPIController::class, 'show']);

// Regioes
Route::get('regioes', [RegiaoAPIController::class, 'index']);
Route::get('regioes/{tipo_regiao_id}', [RegiaoAPIController::class, 'show']);

// Tipos de Região
Route::get('tipo_regioes', [TipoRegiaoAPIController::class, 'index']);