<?php

namespace App\Http\Controllers;

use App\Http\Requests\FonteFormRequest;
use App\Models\Fonte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FonteController extends Controller
{
    public function index(Request $request)
    {
        $data = Fonte::query()->where('ativo', '=', 1)->get();
        $mensagem = $request->session()->get('mensagem');

        return view('cadaux.fontes.index', compact('data','mensagem'));
    }

    public function create(FonteFormRequest $request)
    {
        DB::beginTransaction();
        $fonte = Fonte::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Fonte {$fonte->nome} criada com sucesso");
        return redirect()->route('fontes');
    }

    public function update(int $id, Request $request)
    {
        $fonte = Fonte::find($id);
        $fonte->nome = $request->nome;
        $fonte->descricao = $request->descricao;
        $fonte->save();

        $request->session()->flash('mensagem', "Fonte {$fonte->nome} atualizada com sucesso");
        return redirect()->route('fontes');
    }

    public function destroy(int $id, Request $request)
    {
        $fonte = Fonte::find($id);

        $fonte->ativo = 0;
        $fonte->save();

        $request->session()->flash('mensagem', "Fonte '{$fonte->nome}' removida com sucesso!");
        return redirect()->route('fontes');
    }
}
