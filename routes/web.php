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
        // Route::get('/grafico', [App\Http\Controllers\ChartController::class, 'index'])->name('chart');

        Route::get('/cadaux', [App\Http\Controllers\HomeController::class, 'cadaux'])->name('cadaux');

        // Departamento
        Route::get('/cadaux/departamento', [App\Http\Controllers\DepartamentoController::class, 'index'])->name('departamentos');
        Route::post('/cadaux/departamento/criar', [App\Http\Controllers\DepartamentoController::class, 'create'])->name('departamento-create');
        Route::post('/cadaux/departamento/{id}/editar', [App\Http\Controllers\DepartamentoController::class, 'update'])->name('departamento-update');
        Route::get('/cadaux/departamento/{id}/apagar', [App\Http\Controllers\DepartamentoController::class, 'destroy'])->name('departamento-destroy');

        // Fonte
        Route::get('/cadaux/fonte', [App\Http\Controllers\FonteController::class, 'index'])->name('fontes');
        Route::post('/cadaux/fonte/criar', [App\Http\Controllers\FonteController::class, 'create'])->name('fonte-create');
        Route::post('/cadaux/fonte/{id}/editar', [App\Http\Controllers\FonteController::class, 'update'])->name('fonte-update');
        Route::get('/cadaux/fonte/{id}/apagar', [App\Http\Controllers\FonteController::class, 'destroy'])->name('fonte-destroy');

        // // Tipo Regiao
        // Route::get('/cadaux/tipo_regioes', [App\Http\Controllers\TipoRegiaoController::class, 'index'])->name('tipo_regioes');
        // Route::post('/cadaux/tipo_regiao/criar', [App\Http\Controllers\TipoRegiaoController::class, 'create'])->name('tipo_regiao-create');
        // Route::post('/cadaux/tipo_regiao/{id}/editar', [App\Http\Controllers\TipoRegiaoController::class, 'update'])->name('tipo_regiao-update');
        // Route::get('/cadaux/tipo_regiao/{id}/apagar', [App\Http\Controllers\TipoRegiaoController::class, 'destroy'])->name('tipo_regiao-destroy');

        // Regiao
        Route::get('/cadaux/regioes', [App\Http\Controllers\RegiaoController::class, 'index'])->name('regioes');
        Route::post('/cadaux/regiao/criar', [App\Http\Controllers\RegiaoController::class, 'create'])->name('regiao-create');
        Route::post('/cadaux/regiao/{id}/editar', [App\Http\Controllers\RegiaoController::class, 'update'])->name('regiao-update');
        Route::get('/cadaux/regiao/{id}/apagar', [App\Http\Controllers\RegiaoController::class, 'destroy'])->name('regiao-destroy');

        // Projeto
        Route::get('/projeto', [App\Http\Controllers\ProjetoController::class, 'index'])->name('projeto');
        Route::get('/projeto/novo', [App\Http\Controllers\ProjetoController::class, 'create'])->name('projeto-create');
        Route::post('/projeto/criar', [App\Http\Controllers\ProjetoController::class, 'store'])->name('projeto-store');
        Route::get('/projeto/{id}/visualizar', [App\Http\Controllers\ProjetoController::class, 'show'])->name('projeto-show');
        Route::get('/projeto/{id}/editar', [App\Http\Controllers\ProjetoController::class, 'edit'])->name('projeto-edit');
        Route::post('/projeto/{id}/editar', [App\Http\Controllers\ProjetoController::class, 'update'])->name('projeto-update');

        //Gestão de Usuários e Permissões
        Route::resource('users', App\Http\Controllers\UserController::class)->middleware('permission:user-list');
        Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('permission:role-list');
        Route::resource('permissions', App\Http\Controllers\PermissionController::class)->middleware('permission:permission-list');
    });
});
