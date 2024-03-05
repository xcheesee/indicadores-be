<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::prefix(env('APP_FOLDER', ''))->group(function () { //considerando que o projeto estará em subdiretório em homol/prod
    //Tela inicial
    Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

    //Rotas de login
    Route::get('/entrar', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('entrar');
    Route::post('/entrar', [App\Http\Controllers\Auth\LoginController::class, 'entrar']);
    Route::get('/trocasenha', [App\Http\Controllers\UserController::class, 'trocasenha'])->name('trocasenha')->middleware('autenticador');
    Route::post('/trocasenha', [App\Http\Controllers\UserController::class, 'alterarsenha'])->middleware('autenticador');
    // Route::get('/trocasenha', [App\Http\Controllers\Auth\RegisterController::class, 'criar'])->middleware('autenticador');
    // Route::post('/registrar', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->middleware('autenticador');
    Route::get('/sair', function () {
        Auth::logout();
        return redirect()->route('welcome');
    })->name('sair');

    //Rotas que requerem autenticação
    Route::group(['middleware' => ['autenticador']], function() {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/grafico', [App\Http\Controllers\ChartController::class, 'index'])->name('chart');

        //Gestão de Usuários e Permissões
        Route::resource('users', App\Http\Controllers\UserController::class)->middleware('permission:user-list');
        Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('permission:role-list');
        Route::resource('permissions', App\Http\Controllers\PermissionController::class)->middleware('permission:permission-list');
    });
});
