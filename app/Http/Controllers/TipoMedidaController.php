<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoMedidaRequest;
use App\Models\TipoMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoMedidaController extends Controller
{
    public function index(Request $request) 
    {
        $data = TipoMedida::query()->where('ativo', '=', 1)->get();
        $mensagem = $request->session()->get('mensagem');

        return view('cadaux.medida.index', compact('data','mensagem'));
    }

    public function create(TipoMedidaRequest $request)
    {
        DB::beginTransaction();
        $tipoMedida = TipoMedida::create([
            'nome' => $request->nome,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Medida {$tipoMedida->nome} criada com sucesso");
        return redirect()->route('medidas');
    }

    public function update(int $id, Request $request)
    {
        $tipoMedida = TipoMedida::find($id);
        $tipoMedida->nome = $request->nome;
        $tipoMedida->save();

        $request->session()->flash('mensagem', "Medida {$tipoMedida->nome} atualizada com sucesso");
        return redirect()->route('medidas');
    }

    public function destroy(int $id, Request $request)
    {
        $tipoMedida = TipoMedida::find($id);

        $tipoMedida->ativo = 0;
        $tipoMedida->save();

        $request->session()->flash('mensagem', "Medida '{$tipoMedida->nome}' removida com sucesso!");
        return redirect()->route('medidas');
    }
}
