<?php

namespace App\Http\Controllers;

use App\Http\Requests\VariavelRequest;
use App\Models\Departamento;
use App\Models\Fonte;
use App\Models\Indicador;
use App\Models\IndicadorVariavel;
use App\Models\Metadado;
use App\Models\Regiao;
use App\Models\TipoDado;
use App\Models\TipoMedida;
use App\Models\TipoRegiao;
use App\Models\Variavel;
use App\Models\VariavelValor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariavelController extends Controller
{
    public function index(Request $request)
    {
        $filtros = array();
        $filtros['nome'] = $request->query('nome');
        $filtros['codigo'] = $request->query('codigo');
        $filtros['departamento_id'] = $request->query('departamento');
        $filtros['fonte_id'] = $request->query('fonte');
        
        $data = Variavel::query()
            ->orderBy('id', 'DESC')
            ->select('variaveis.*')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'variaveis.departamento_id')
            ->leftJoin('fontes', 'fontes.id', '=', 'variaveis.fonte_id')
            ->leftJoin('tipo_dados', 'tipo_dados.id', '=', 'variaveis.tipo_dado_id')
            ->when($filtros['nome'], function ($query, $val) {
                return $query->where('variaveis.nome','like','%'.$val.'%');
            })
            ->when($filtros['codigo'], function ($query, $val) {
                return $query->where('variaveis.codigo','like','%'.$val.'%');
            })
            ->when($filtros['departamento_id'], function ($query, $val) {
                return $query->where('variaveis.departamento_id','like','%'.$val.'%');
            })
            ->when($filtros['fonte_id'], function ($query, $val) {
                return $query->where('variaveis.fonte_id','like','%'.$val.'%');
            })
            ->where('variaveis.ativo', '=', 1)
            ->paginate(10);

        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $fontes = Fonte::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.variaveis.index', compact('data','mensagem','filtros','departamentos','fontes'));
    }

    public function create(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $tipo_dados = TipoDado::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $fontes = Fonte::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $tipo_medidas = TipoMedida::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $indicadores = Indicador::query()->where('ativo', '=', 1)->orderBy('nome')->get();

        return view('publicacao.variaveis.create', compact('mensagem', 'departamentos', 'tipo_dados', 'fontes', 'tipo_medidas', 'indicadores'));
    }

    public function store(VariavelRequest $request)
    {
        // dd($imagem);
        DB::beginTransaction();
        $metadados = Metadado::create([
            'tipo_medida_id' => $request->tipo_medida,
            'serie_historica_inicio' => $request->inicio_serie_historica,
            'serie_historica_fim' => $request->fim_serie_historica,
            'nota_tecnica' => $request->nota_tecnica,
            'organizacao' => $request->organizacao,
            'observacao' => $request->observacao,
        ]);
        
        $variavel = Variavel::create([
            'codigo' => strtoupper($request->codigo),
            'nome' => $request->nome,
            'departamento_id' => $request->departamento,
            'tipo_dado_id' => $request->tipo_dado,
            'fonte_id' => $request->fonte,
        ]);

        IndicadorVariavel::create([
            'indicador_id' => $request->indicador,
            'variavel_id' => $variavel->id,
        ]);
        DB::commit();
        
        $variavel->metadados_id = $metadados->id;
        DB::beginTransaction();
        $variavel->save();
        DB::commit();


        $request->session()->flash('mensagem', "Variável '{$variavel->nome}' criada com sucesso!");
        return redirect()->route('variaveis');
    }

    public function show(int $id, Request $request)
    {
        // Info: Variáveis
        $variavel = Variavel::findOrFail($id);
        $departamento = Departamento::where('id', '=', $variavel->departamento_id)->first();
        $metadados = Metadado::where('id', '=', $variavel->metadados_id)->first();
        $fontes = Fonte::where('id', '=', $variavel->fonte_id)->first();
        $tipo_dados = TipoDado::where('id', '=', $variavel->tipo_dado_id)->first();
        $tipo_medida = TipoMedida::where('id', '=', $metadados->tipo_medida_id)->first();
        $indicador_variavel = IndicadorVariavel::where('variavel_id', '=', $id)->first();
        $indicador = Indicador::where('id', '=', $indicador_variavel->indicador_id)->first();

        // Info: Valor
        $regioes = Regiao::query()
            ->select('regioes.*')
            ->leftJoin('tipo_regioes', 'tipo_regioes.id', '=', 'regioes.tipo_regiao_id')
            ->where('regioes.ativo', '=', 1)
            ->orderBy('nome')
            ->get();
        $valores = VariavelValor::query()
            ->orderBy('regioes.nome', 'ASC')
            ->select('variavel_valores.*')
            ->leftJoin('valores', 'valores.id', '=', 'variavel_valores.valor_id')
            ->leftJoin('regioes', 'regioes.id', '=', 'valores.regiao_id')
            ->where('variavel_valores.variavel_id', '=', $id)
            ->where('valores.ativo', '=', 1)
            ->get();

        $tipo_regiao = TipoRegiao::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.variaveis.show', compact('variavel', 'departamento', 'metadados', 'tipo_dados', 'fontes', 'tipo_medida', 'regioes', 'valores', 'mensagem', 'indicador', 'tipo_regiao'));
    }

    public function edit(int $id, Request $request)
    {
        $variavel = Variavel::findOrFail($id);
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $tipo_dados = TipoDado::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $fontes = Fonte::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $metadados = Metadado::query()->where('id', '=', $variavel->id)->first();
        $tipo_medidas = TipoMedida::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $indicadores = Indicador::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $indicador_variavel = IndicadorVariavel::query()->where('variavel_id', '=', $variavel->id)->first();

        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.variaveis.edit', compact('variavel', 'departamentos', 'mensagem', 'tipo_dados', 'fontes', 'metadados', 'tipo_medidas', 'indicadores', 'indicador_variavel'));
    }

    public function update(int $id, VariavelRequest $request)
    {
        $variavel = Variavel::findOrFail($id);
        $metadados = Metadado::find($variavel->metadados_id);
        $indicador_variavel = IndicadorVariavel::where('variavel_id', '=', $id)->firstOrFail();

        $variavel->nome = $request->nome;
        $variavel->codigo = $request->codigo;
        $variavel->departamento_id = $request->departamento;
        $variavel->tipo_dado_id = $request->tipo_dado;
        $variavel->fonte_id = $request->fonte;

        $metadados->tipo_medida_id = $request->tipo_medida;
        $metadados->serie_historica_inicio = $request->inicio_serie_historica;
        $metadados->serie_historica_fim = $request->fim_serie_historica;
        $metadados->nota_tecnica = $request->nota_tecnica;
        $metadados->organizacao = $request->organizacao;
        $metadados->observacao = $request->observacao;

        $indicador_variavel->indicador_id = $request->indicador;

        DB::beginTransaction();
        $variavel->save();
        $metadados->save();
        $indicador_variavel->save();
        DB::commit();

        $request->session()->flash('mensagem',"Variável '{$variavel->nome}' (ID {$variavel->id}) editado com sucesso!");
        return redirect()->route('variaveis');
    }

    public function destroy(int $id, Request $request)
    {
        $variavel = Variavel::find($id);

        $variavel->ativo = 0;
        $variavel->save();

        $request->session()->flash('mensagem', "Variável '{$variavel->nome}' removida com sucesso!");
        return redirect()->route('variaveis');
    }
}
