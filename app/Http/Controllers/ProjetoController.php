<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjetoUpdateRequest;
use App\Http\Requests\StoreProjetoRequest;
use App\Http\Resources\IndicadorResource;
use App\Models\Departamento;
use App\Models\Indicador;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjetoController extends Controller
{
    public function index(Request $request) 
    {
        $filtros = array();
        $filtros['nome'] = $request->query('nome');
        $filtros['departamento_id'] = $request->query('departamento');
        $filtros['visivel'] = $request->query('visivel');

        $data = Projeto::query()
            ->orderBy('id', 'ASC')
            ->select('projetos.*')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'projetos.departamento_id')
            ->when($filtros['nome'], function ($query, $val) {
                return $query->where('projetos.nome','like','%'.$val.'%');
            })
            ->when($filtros['departamento_id'], function ($query, $val) {
                return $query->where('projetos.departamento_id','like','%'.$val.'%');
            })
            ->when($filtros['visivel'], function ($query, $val) {
                return $query->where('projetos.visivel','like','%'.$val.'%');
            })
            ->where('projetos.ativo', '=', 1)
            ->paginate(10);

        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();

        $indicadores = Indicador::select('indicadores.projeto_id')->groupBy()->get();

        // $indicador_variavel = IndicadorVariavel::select('indicador_variaveis.*')->groupBy()->get();
        
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.projeto.index', compact('data','mensagem', 'departamentos', 'filtros', 'indicadores'));
    }

    public function create(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();

        return view('publicacao.projeto.create', compact('mensagem', 'departamentos'));
    }

    public function store(StoreProjetoRequest $request) 
    {   
        if($request->hasFile('imagem')){
            $upload = $request->file('imagem');
            $extensao = $upload->extension();

            $nome_imagem_formatado = preg_replace('/( )+/', '_', mb_strtolower($request->nome));
            $arquivo = $upload->storeAs('imagens', 'projeto_'.$nome_imagem_formatado.'.'.$extensao);
            $projeto_imagem['imagem'] = $arquivo;
        }

        $imagem = $projeto_imagem['imagem'];
        // dd($imagem);
        DB::beginTransaction();
        $projeto = Projeto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'departamento_id' => $request->departamento,
            'imagem' => $imagem,
            'visivel' => $request->visivel,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Projeto '{$projeto->nome}' criada com sucesso!");
        return redirect()->route('projetos'); 
    }

    public function show(int $id, Request $request)
    {
        // Projeto
        $projeto = Projeto::findOrFail($id);
        $departamento = Departamento::where('id', '=', $projeto->departamento_id)->first();

        // Indicador
        $indicadores = Indicador::query()
            ->orderBy('id', 'ASC')
            ->select('indicadores.*')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'indicadores.departamento_id')
            ->leftJoin('projetos', 'projetos.id', '=', 'indicadores.projeto_id')
            ->leftJoin('fontes', 'fontes.id', '=', 'indicadores.fonte_id')
            ->where('indicadores.projeto_id', '=', $id)
            ->where('indicadores.ativo', '=', 1)
            ->paginate(5);
            
        $mensagem = $request->session()->get('mensagem');

        return view('publicacao.projeto.show', compact('mensagem', 'projeto', 'departamento', 'indicadores'));
    }

    public function edit(int $id)
    {
        $projeto = Projeto::findOrFail($id);
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();

        
        return view('publicacao.projeto.edit', compact('projeto', 'departamentos'));
    }

    public function update(int $id, ProjetoUpdateRequest $request)
    {
        $projeto = Projeto::findOrFail($id);

        if($request->hasFile('imagem')){ 
            $nome_imagem_formatado = preg_replace('/( )+/', '_', mb_strtolower($projeto->nome)); 
            Storage::delete(['projeto_'.$nome_imagem_formatado]);

            $upload = $request->file('imagem');
            $extensao = $upload->extension();

            $arquivo = $upload->storeAs('imagens', 'projeto_'.$nome_imagem_formatado.'.'.$extensao);
            $projeto_imagem['imagem'] = $arquivo;

            $projeto->imagem = $projeto_imagem['imagem'];
        }

        $projeto->nome = $request->nome;
        $projeto->descricao = $request->descricao;
        $projeto->departamento_id = $request->departamento;
        // $projeto->imagem = $request->nome;
        $projeto->visivel = $request->visivel;

        DB::beginTransaction();
        $projeto->save();
        DB::commit();

        $request->session()->flash('mensagem',"Projeto '{$projeto->nome}' (ID {$projeto->id}) editado com sucesso!");
        return redirect()->route('projeto-show', $projeto->id);
    }

    public function destroy(int $id, Request $request)
    {
        $projeto = Projeto::find($id);

        $indicadores = Indicador::select('indicadores.projeto_id')->where('projeto_id', '=', $id)->count();
        if ($indicadores > 0) {
            return back()->withErrors([
                'O Projeto contém Indicadores'
            ]);
        }

        $projeto->ativo = 0;
        $projeto->save();

        $request->session()->flash('mensagem', "Projeto '{$projeto->nome}' removida com sucesso!");
        return redirect()->route('projetos');
    }

    public function filtrar(int $id) {
        $indicador = Indicador::query()
        ->where('projeto_id', '=', $id)
        ->orderBy('nome')
        ->get();

        return IndicadorResource::collection($indicador);
    }
}
