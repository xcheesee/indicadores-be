<?php

use App\Http\Controllers\API\IndicadorApiController;
use App\Http\Controllers\API\ProjetoApiController;
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

Route::get('projetos', [ProjetoApiController::class, 'index']);


Route::get('indicadores', [IndicadorApiController::class, 'index']);
Route::get('indicadores/{projeto_id}', [IndicadorApiController::class, 'show']);
