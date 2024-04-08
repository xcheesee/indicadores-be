<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjetoRequest;
use App\Models\Departamento;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjetoController extends Controller
{
    public function index(Request $request) 
    {
        $data = Projeto::query()
            ->orderBy('id', 'ASC')
            ->select('projetos.*')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'projetos.departamento_id')
            ->paginate(10);
        
        $mensagem = $request->session()->get('mensagem');
        return view('projeto.index', compact('data','mensagem'));
    }

    public function create(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('id')->get();

        return view('projeto.create', compact('mensagem', 'departamentos'));
    }

    public function store(StoreProjetoRequest $request) 
    {   
        DB::beginTransaction();
        $projeto = Projeto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'departamento_id' => $request->departamento_id,
            'imagem' => 'Sem Imagem',
            'ativo' => $request->ativo,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Projeto '{$projeto->nome}' criada com sucesso!");
        return redirect()->route('projeto');
    }

    public function show($id, Request $request)
    {
        $projeto = Projeto::findOrFail($id);
        $departamento = Departamento::where('id', '=', $projeto->departamento_id)->first();
            
        $mensagem = $request->session()->get('mensagem');

        return view('projeto.show', compact('mensagem', 'projeto', 'departamento'));
    }

    public function edit($id)
    {
        $projeto = Projeto::findOrFail($id);
        $departamentos = Departamento::query()->where('ativo', '=', 1)->orderBy('id')->get();

        
        return view('projeto.edit', compact('projeto', 'departamentos'));
    }

    public function update($id, StoreProjetoRequest $request)
    {
        $projeto = Projeto::findOrFail($id);

        $projeto->nome = $request->nome;
        $projeto->descricao = $request->descricao;
        $projeto->departamento_id = $request->departamento_id;
        // $projeto->imagem = $request->nome;
        $projeto->ativo = $request->ativo;

        DB::beginTransaction();
        $projeto->save();
        DB::commit();

        $request->session()->flash('mensagem',"Projeto '{$projeto->nome}' (ID {$projeto->id}) editado com sucesso!");
        return redirect()->route('projeto-show', $projeto->id);
    }

    public function destroy()
    {

    }
}
