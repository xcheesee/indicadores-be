<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegiaoFormRequest;
use App\Models\Regiao;
use App\Models\TipoRegiao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegiaoController extends Controller
{
    public function index(Request $request)
    {
        $data = Regiao::query()
        ->select('regioes.*')
        ->where('regioes.ativo', '=', 1)
        ->leftJoin('tipo_regioes', 'tipo_regioes.id', '=', 'regioes.tipo_regiao_id')
        ->get();
        $tipo_regiao = TipoRegiao::query()->where('ativo', '=', 1)->get();
        $mensagem = $request->session()->get('mensagem');

        return view('cadaux.regioes.index', compact('data','mensagem', 'tipo_regiao'));
    }

    public function create(RegiaoFormRequest $request)
    {
        DB::beginTransaction();
        $regiao = Regiao::create([
            'nome' => $request->nome,
            'sigla' => $request->sigla,
            'tipo_regiao_id' => $request->tipo_regiao_id,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Região {$regiao->nome} criada com sucesso");
        return redirect()->route('regioes');
    }

    public function update(int $id, RegiaoFormRequest $request)
    {
        $regiao = Regiao::find($id);
        $regiao->nome = $request->nome;
        $regiao->sigla = $request->sigla;
        $regiao->tipo_regiao_id = $request->tipo_regiao_id;
        $regiao->save();

        $request->session()->flash('mensagem', "Região {$regiao->nome} atualizada com sucesso");
        return redirect()->route('regioes');
    }

    public function destroy(int $id, Request $request)
    {
        $regiao = Regiao::find($id);

        $regiao->ativo = 0;
        $regiao->save();

        $request->session()->flash('mensagem', "Região '{$regiao->nome}' removida com sucesso!");
        return redirect()->route('departamentos');
    }
}
