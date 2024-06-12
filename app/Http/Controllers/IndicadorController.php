<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndicadorFormRequest;
use App\Http\Requests\IndicadorUpdateRequest;
use App\Http\Resources\IndicadorResource;
use App\Models\Departamento;
use App\Models\Fonte;
use App\Models\Indicador;
use App\Models\IndicadorVariavel;
use App\Models\Periodicidade;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndicadorController extends Controller
{
    public function index(Request $request)
    {
        $filtros = array();
        $filtros['nome'] = $request->query('nome');
        $filtros['projeto_id'] = $request->query('projeto');
        $filtros['departamento_id'] = $request->query('departamento');
        $filtros['fonte_id'] = $request->query('fonte');

        $data = Indicador::query()
            ->orderBy('id', 'ASC')
            ->select('indicadores.*')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'indicadores.departamento_id')
            ->leftJoin('projetos', 'projetos.id', '=', 'indicadores.projeto_id')
            ->leftJoin('fontes', 'fontes.id', '=', 'indicadores.fonte_id')
            ->when($filtros['nome'], function ($query, $val){
                return $query->where('indicadores.nome', 'like', '%'.$val.'%');
            })
            ->when($filtros['projeto_id'], function ($query, $val){
                return $query->where('indicadores.projeto_id', 'like', '%'.$val.'%');
            })
            ->when($filtros['departamento_id'], function ($query, $val){
                return $query->where('indicadores.departamento_id', 'like', '%'.$val.'%');
            })
            ->when($filtros['fonte_id'], function ($query, $val){
                return $query->where('indicadores.fonte_id', 'like', '%'.$val.'%');
            })
            ->where('indicadores.ativo', '=', 1)
            ->paginate(10);

        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $projetos = Projeto::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $fontes = Fonte::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');

        $indicador_variavel = IndicadorVariavel::select('indicador_variaveis.indicador_id')->groupBy()->get();
        
        return view('publicacao.indicadores.index', compact('mensagem', 'departamentos', 'filtros', 'data', 'projetos', 'fontes', 'indicador_variavel'));
    }

    public function create(Request $request)
    {
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $projetos = Projeto::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $fontes = Fonte::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $periodicidades = Periodicidade::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.indicadores.create', compact('mensagem', 'projetos', 'fontes', 'departamentos', 'periodicidades'));
    }

    public function store(IndicadorFormRequest $request)
    {
        if($request->hasFile('imagem')){
            $upload = $request->file('imagem');
            $extensao = $upload->extension();

            $nome_imagem_formatado = preg_replace('/( )+/', '_', mb_strtolower($request->nome));
            $arquivo = $upload->storeAs('imagens/indicador', 'indicador_'.$nome_imagem_formatado.'.'.$extensao);
            $indicador_imagem['imagem'] = $arquivo;
        }

        $imagem = $indicador_imagem['imagem'];
        DB::beginTransaction();
        $indicador = Indicador::create([
            'nome' => $request->nome,
            'departamento_id' => $request->departamento,
            'projeto_id' => $request->projeto,
            'fonte_id' => $request->fonte,
            'periodicidade_id' => $request->periodicidade,
            'nota_tecnica' => $request->nota_tecnica,
            'observacao' => $request->observacao,
            'imagem' => $imagem,
            'formula' => 'Sem Formula'
        ]);
        DB::commit();
        
        $request->session()->flash('mensagem', "Indicador '{$indicador->nome}' criada com sucesso!");
        return redirect()->route('indicadores');
    }

    public function show(int $id, Request $request)
    {
        // Indicador
        $indicador = Indicador::findOrFail($id);
        $projeto = Projeto::where('id', '=', $indicador->projeto_id)->first();
        $departamento = Departamento::where('id', '=', $indicador->departamento_id)->first();
        $fonte = Fonte::where('id', '=', $indicador->fonte_id)->first();
        $periodicidade = Periodicidade::where('id', '=', $indicador->periodicidade_id)->first();

        // Variáveis
        $variaveis = IndicadorVariavel::query()
            ->select('indicador_variaveis.*')
            ->leftJoin('variaveis', 'variaveis.id', '=', 'indicador_variaveis.variavel_id')
            ->where('indicador_variaveis.indicador_id', '=', $id)
            ->paginate(5);
        
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.indicadores.show', compact('mensagem', 'indicador', 'departamento', 'fonte', 'periodicidade', 'projeto', 'variaveis'));
    }

    public function edit(int $id, Request $request)
    {
        $indicador = Indicador::findOrFail($id);
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $projetos = Projeto::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $fontes = Fonte::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $periodicidades = Periodicidade::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.indicadores.edit', compact('mensagem', 'indicador', 'departamentos', 'projetos', 'fontes', 'periodicidades'));
    }

    public function update(int $id, IndicadorUpdateRequest $request)
    {
        $indicador = Indicador::findOrFail($id);

        if($request->hasFile('imagem')){  
            $nome_imagem_formatado = preg_replace('/( )+/', '_', mb_strtolower($indicador->nome));
            Storage::delete(['indicador/indicador_'.$nome_imagem_formatado]);

            $upload = $request->file('imagem');
            $extensao = $upload->extension();

            $arquivo = $upload->storeAs('imagens/indicador', 'indicador_'.$nome_imagem_formatado.'.'.$extensao);
            $indicador_imagem['imagem'] = $arquivo;

            $indicador->imagem = $indicador_imagem['imagem'];
        }

        $indicador->nome = $request->nome;
        $indicador->departamento_id = $request->departamento;
        $indicador->projeto_id = $request->projeto;
        $indicador->fonte_id = $request->fonte;
        $indicador->periodicidade_id = $request->periodicidade;
        $indicador->nota_tecnica = $request->nota_tecnica;
        $indicador->observacao = $request->observacao;

        DB::beginTransaction();
        $indicador->save();
        DB::commit();
        
        $request->session()->flash('mensagem',"Indicador '{$indicador->nome}' (ID {$indicador->id}) editado com sucesso!");
        return redirect()->route('indicadores', $indicador->id);
    }

    public function destroy(int $id, Request $request)
    {
        $indicador = Indicador::find($id);

        $indicador_variavel = IndicadorVariavel::select('indicador_variaveis.indicador_id')->where('indicador_id', '=', $id)->count();
        if($indicador_variavel > 0) {
            return back()->withErrors([
                'O Indicador contém Variáveis'
            ]);
        }

        $indicador->ativo = 0;
        $indicador->save();
        
        $request->session()->flash('mensagem', "Indicador '{$indicador->nome}' removido com sucesso!");
        return redirect()->route('indicadores');
    }

    public function getIndicador(int $id){
        return new IndicadorResource(Indicador::findOrFail($id));
    }
}
