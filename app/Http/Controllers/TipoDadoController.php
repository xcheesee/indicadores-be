<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoDadoFormRequest;
use App\Models\TipoDado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoDadoController extends Controller
{
    public function index(Request $request) 
    {
        $data = TipoDado::query()->where('ativo', '=', 1)->get();
        $mensagem = $request->session()->get('mensagem');

        return view('cadaux.tipoDado.index', compact('data','mensagem'));
    }

    public function create(TipoDadoFormRequest $request)
    {
        DB::beginTransaction();
        $tipoDado= TipoDado::create([
            'nome' => $request->nome,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Dado {$tipoDado->nome} criada com sucesso");
        return redirect()->route('tipo_dados');
    }

    public function update(int $id, Request $request)
    {
        $tipoDado = TipoDado::find($id);
        $tipoDado->nome = $request->nome;
        $tipoDado->save();

        $request->session()->flash('mensagem', "Dado {$tipoDado->nome} atualizada com sucesso");
        return redirect()->route('tipo_dados');
    }

    public function destroy(int $id, Request $request)
    {
        $tipoDado = TipoDado::find($id);

        $tipoDado->ativo = 0;
        $tipoDado->save();

        $request->session()->flash('mensagem', "Dado '{$tipoDado->nome}' removida com sucesso!");
        return redirect()->route('tipo_dados');
    }
}
