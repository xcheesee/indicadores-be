<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentoFormRequest;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    public function index(Request $request)
    {   
        $data = Departamento::query()->where('ativo', '=', 1)->get();
        $mensagem = $request->session()->get('mensagem');

        return view('cadaux.departamentos.index', compact('data','mensagem'));
    }

    public function create(DepartamentoFormRequest $request)
    {
        DB::beginTransaction();
        $departamento = Departamento::create([
            'nome' => $request->nome,
            'sigla' => $request->sigla,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Departamento {$departamento->nome} criado com sucesso");
        return redirect()->route('departamentos');
    }

    public function update(int $id, DepartamentoFormRequest $request)
    {
        $departamento = Departamento::find($id);
        $departamento->nome = $request->nome;
        $departamento->sigla = $request->sigla;
        $departamento->save();

        $request->session()->flash('mensagem', "Departamento {$departamento->nome} atualizado com sucesso");
        return redirect()->route('departamentos');
    }

    public function destroy(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        $departamento->ativo = 0;
        $departamento->save();

        $request->session()->flash('mensagem', "Departamento '{$departamento->nome}' removido com sucesso!");
        return redirect()->route('departamentos');
    }
}
