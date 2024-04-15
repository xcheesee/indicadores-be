<?php

namespace App\Http\Controllers;

use App\Http\Requests\VariavelRequest;
use App\Models\Departamento;
use App\Models\Fonte;
use App\Models\TipoDado;
use App\Models\Variavel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariavelController extends Controller
{
    public function index(Request $request)
    {
        // $filtros = array();
        // $filtros['nome'] = $request->query('nome');
        // $filtros['departamento_id'] = $request->query('departamento');
        // $filtros['visivel'] = $request->query('visivel');
        
        $data = Variavel::query()
            ->orderBy('id', 'ASC')
            ->select('variavies.*')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'variaveis.departamento_id')
            // ->when($filtros['nome'], function ($query, $val) {
            //     return $query->where('projetos.nome','like','%'.$val.'%');
            // })
            // ->when($filtros['departamento_id'], function ($query, $val) {
            //     return $query->where('projetos.departamento_id','like','%'.$val.'%');
            // })
            // ->when($filtros['visivel'], function ($query, $val) {
            //     return $query->where('projetos.visivel','like','%'.$val.'%');
            // })
            ->where('variaveis.ativo', '=', 1)
            ->paginate(10);
        
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.variaveis.index', compact('data','mensagem'));
    }

    public function create(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $tipo_dados = TipoDado::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $fontes = Fonte::query()->where('ativo', '=', 1)->orderBy('nome')->get();

        return view('publicacao.variaveis.create', compact('mensagem', 'departamentos', 'tipo_dados', 'fontes'));
    }

    public function store(VariavelRequest $request)
    {
        // dd($imagem);
        DB::beginTransaction();
        $projeto = Variavel::create([
            'codigo' => $request->codigo,
            'nome' => $request->nome,
            'departamento_id' => $request->departamento,
            'tipo_dado_id' => $request->tipo_dado,
            'fonte_id' => $request->fonte,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Variável '{$projeto->nome}' criada com sucesso!");
        return redirect()->route('variavies');
    }

    public function show(int $id, Request $request)
    {

    }

    public function edit(int $id, Request $request)
    {

    }

    public function update(int $id, VariavelRequest $request)
    {

    }

    public function destroy(int $id, Request $request)
    {

    }
}
