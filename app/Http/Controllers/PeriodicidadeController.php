<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodicidadeFormRequest;
use App\Models\Periodicidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodicidadeController extends Controller
{
    public function index(Request $request) 
    {
        $data = Periodicidade::query()->where('ativo', '=', 1)->get();
        $mensagem = $request->session()->get('mensagem');

        return view('cadaux.periodicidades.index', compact('data','mensagem'));
    }

    public function create(PeriodicidadeFormRequest $request) 
    {
        // dd(intval($request->qtd_meses));
        DB::beginTransaction();
        $periodicidade = Periodicidade::create([
            'nome' => $request->nome,
            'qtd_meses' => $request->qtd_meses,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Periodicidade {$periodicidade->nome} criada com sucesso");
        return redirect()->route('periodicidades');
    }

    public function update(int $id, PeriodicidadeFormRequest $request) 
    {
        $periodicidade = Periodicidade::find($id);
        $periodicidade->nome = $request->nome;
        $periodicidade->qtd_meses = $request->qtd_meses;
        $periodicidade->save();

        $request->session()->flash('mensagem', "Periodicidade {$periodicidade->nome} atualizada com sucesso");
        return redirect()->route('periodicidades');
    }

    public function destroy(int $id, Request $request) 
    {
        $periodicidade = Periodicidade::find($id);

        $periodicidade->ativo = 0;
        $periodicidade->save();

        $request->session()->flash('mensagem', "Periodicidade '{$periodicidade->nome}' removida com sucesso!");
        return redirect()->route('periodicidades');
    }
}
