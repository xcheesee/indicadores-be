<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoRegiaoRequest;
use App\Models\TipoRegiao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoRegiaoController extends Controller
{
    public function index(Request $request)
    {
        $data = TipoRegiao::query()->where('ativo', '=', 1)->get();
        $mensagem = $request->session()->get('mensagem');

        return view('cadaux.tipoRegiao.index', compact('data','mensagem'));
    }

    public function create(TipoRegiaoRequest $request)
    {
        DB::beginTransaction();
        $tipoRegiao = TipoRegiao::create([
            'nome' => $request->nome,
            'sigla' => $request->sigla,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Fonte {$tipoRegiao->nome} criada com sucesso");
        return redirect()->route('tipo_regioes');
    }

    public function update(int $id, Request $request)
    {
        $tipoRegiao = TipoRegiao::find($id);
        $tipoRegiao->nome = $request->nome;
        $tipoRegiao->sigla = $request->sigla;
        $tipoRegiao->save();

        $request->session()->flash('mensagem', "Fonte {$tipoRegiao->nome} atualizada com sucesso");
        return redirect()->route('tipo_regioes');
    }

    public function destroy(int $id, Request $request)
    {
        $tipoRegiao = TipoRegiao::find($id);

        $tipoRegiao->ativo = 0;
        $tipoRegiao->save();

        $request->session()->flash('mensagem', "Fonte '{$tipoRegiao->nome}' removida com sucesso!");
        return redirect()->route('tipo_regioes');
    }
}
