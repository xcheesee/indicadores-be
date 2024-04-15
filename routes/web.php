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
        Route::get('/publicacao', [App\Http\Controllers\HomeController::class, 'publicacao'])->name('publicacao');

        // CADASTROS AUXILIARES

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

        // Tipo Regiao
        Route::get('/cadaux/tipo_regioes', [App\Http\Controllers\TipoRegiaoController::class, 'index'])->name('tipo_regioes');
        Route::post('/cadaux/tipo_regiao/criar', [App\Http\Controllers\TipoRegiaoController::class, 'create'])->name('tipo_regiao-create');
        Route::post('/cadaux/tipo_regiao/{id}/editar', [App\Http\Controllers\TipoRegiaoController::class, 'update'])->name('tipo_regiao-update');
        Route::get('/cadaux/tipo_regiao/{id}/apagar', [App\Http\Controllers\TipoRegiaoController::class, 'destroy'])->name('tipo_regiao-destroy');

        // Regiao
        Route::get('/cadaux/regioes', [App\Http\Controllers\RegiaoController::class, 'index'])->name('regioes');
        Route::post('/cadaux/regiao/criar', [App\Http\Controllers\RegiaoController::class, 'create'])->name('regiao-create');
        Route::post('/cadaux/regiao/{id}/editar', [App\Http\Controllers\RegiaoController::class, 'update'])->name('regiao-update');
        Route::get('/cadaux/regiao/{id}/apagar', [App\Http\Controllers\RegiaoController::class, 'destroy'])->name('regiao-destroy');

        // Periodicidade
        Route::get('/cadaux/periodicidades', [App\Http\Controllers\PeriodicidadeController::class, 'index'])->name('periodicidades');
        Route::post('/cadaux/periodicidade/criar', [App\Http\Controllers\PeriodicidadeController::class, 'create'])->name('periodicidade-create');
        Route::post('/cadaux/periodicidade/{id}/editar', [App\Http\Controllers\PeriodicidadeController::class, 'update'])->name('periodicidade-update');
        Route::get('/cadaux/periodicidade/{id}/apagar', [App\Http\Controllers\PeriodicidadeController::class, 'destroy'])->name('periodicidade-destroy');

        // Tipo de Dado
        Route::get('/cadaux/tipo_dados', [App\Http\Controllers\TipoDadoController::class, 'index'])->name('tipo_dados');
        Route::post('/cadaux/tipo_dado/criar', [App\Http\Controllers\TipoDadoController::class, 'create'])->name('tipo_dado-create');
        Route::post('/cadaux/tipo_dado/{id}/editar', [App\Http\Controllers\TipoDadoController::class, 'update'])->name('tipo_dado-update');
        Route::get('/cadaux/tipo_dado/{id}/apagar', [App\Http\Controllers\TipoDadoController::class, 'destroy'])->name('tipo_dado-destroy');

        // Tipo de Medida
        Route::get('/cadaux/medidas', [App\Http\Controllers\TipoMedidaController::class, 'index'])->name('medidas');
        Route::post('/cadaux/medida/criar', [App\Http\Controllers\TipoMedidaController::class, 'create'])->name('medida-create');
        Route::post('/cadaux/medida/{id}/editar', [App\Http\Controllers\TipoMedidaController::class, 'update'])->name('medida-update');
        Route::get('/cadaux/medida/{id}/apagar', [App\Http\Controllers\TipoMedidaController::class, 'destroy'])->name('medida-destroy');

        // PUBLICAÇÃO

        // Projeto
        Route::get('/publicacao/projeto', [App\Http\Controllers\ProjetoController::class, 'index'])->name('projetos');
        Route::get('/publicacao/projeto/novo', [App\Http\Controllers\ProjetoController::class, 'create'])->name('projeto-create');
        Route::post('/projeto/criar', [App\Http\Controllers\ProjetoController::class, 'store'])->name('projeto-store');
        Route::get('/publicacao/projeto/{id}/visualizar', [App\Http\Controllers\ProjetoController::class, 'show'])->name('projeto-show');
        Route::get('/publicacao/projeto/{id}/editar', [App\Http\Controllers\ProjetoController::class, 'edit'])->name('projeto-edit');
        Route::post('/projeto/{id}/editar', [App\Http\Controllers\ProjetoController::class, 'update'])->name('projeto-update');
        Route::get('/projeto/{id}/destroy', [App\Http\Controllers\ProjetoController::class, 'destroy'])->name('projeto-destroy');

        // Indicador
        Route::get('/publicacao/indicadores', [App\Http\Controllers\IndicadorController::class, 'index'])->name('indicadores');
        Route::get('/publicacao/indicador/novo', [App\Http\Controllers\IndicadorController::class, 'create'])->name('indicador-create');
        Route::post('/indicador/criar', [App\Http\Controllers\IndicadorController::class, 'store'])->name('indicador-store');
        Route::get('/publicacao/indicador/{id}/visualizar', [App\Http\Controllers\IndicadorController::class, 'show'])->name('indicador-show');
        Route::get('/publicacao/indicador/{id}/editar', [App\Http\Controllers\IndicadorController::class, 'edit'])->name('indicador-edit');
        Route::post('/indicador/{id}/editar', [App\Http\Controllers\IndicadorController::class, 'update'])->name('indicador-update');
        Route::get('/indicador/{id}/destroy', [App\Http\Controllers\IndicadorController::class, 'destroy'])->name('indicador-destroy');

        // Variavel
        Route::get('/publicacao/variaveis', [App\Http\Controllers\VariavelController::class, 'index'])->name('variaveis');
        Route::get('/publicacao/variavel/novo', [App\Http\Controllers\VariavelController::class, 'create'])->name('variavel-create');
        Route::post('/variavel/criar', [App\Http\Controllers\VariavelController::class, 'store'])->name('variavel-store');
        Route::get('/publicacao/variavel/{id}/visualizar', [App\Http\Controllers\VariavelController::class, 'show'])->name('variavel-show');
        Route::get('/publicacao/variavel/{id}/editar', [App\Http\Controllers\VariavelController::class, 'edit'])->name('variavel-edit');
        Route::post('/variavel/{id}/editar', [App\Http\Controllers\VariavelController::class, 'update'])->name('variavel-update');
        Route::get('/variavel/{id}/destroy', [App\Http\Controllers\VariavelController::class, 'destroy'])->name('variavel-destroy');

        //Gestão de Usuários e Permissões
        Route::resource('users', App\Http\Controllers\UserController::class)->middleware('permission:user-list');
        Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('permission:role-list');
        Route::resource('permissions', App\Http\Controllers\PermissionController::class)->middleware('permission:permission-list');
    });
});
