<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValorFormRequest;
use App\Models\Valor;
use App\Models\VariavelValor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValorController extends Controller
{
    public function index(Request $request)
    {
        $valores = Valor::query()
            ->orderBy('regiao.nome', 'ASC')
            ->select('valores.regiao_id', 'valores.periodo', 'valores.valor')
            ->leftJoin('regioes', 'regioes.id', '=', 'valores.regiao_id')
            ->where('valores.ativo', '=', 1);

        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.variaveis.show', compact('valores'));
    }

    public function create(ValorFormRequest $request, int $variavelId)
    {
        $valor_formatado = str_replace(",",".", $request->valor);
        DB::beginTransaction();
        $valor = Valor::create([
            'regiao_id' => $request->regiao,
            'periodo' => $request->periodo,
            'valor' => $valor_formatado,
        ]);

        VariavelValor::create([
            'variavel_id' => $variavelId,
            'valor_id' => $valor->id,
        ]);
        DB::commit();

        $request->session()->flash('mensagem', "Valor {$valor->nome} criado com sucesso!");
        return redirect()->route('variavel-show', $variavelId);
    }

    public function update(int $id, Request $request, int $variavelId)
    {
        $valor = Valor::find($id);

        $valor_formatado = str_replace(",",".", $request->valor);

        $valor->regiao_id = $request->regiao;
        $valor->periodo = $request->periodo;
        $valor->valor = $valor_formatado;

        $valor->save();

        $request->session()->flash('mensagem', "Valor {$valor->nome} atualizado com sucesso!");
        return redirect()->route('variavel-show', $variavelId);
    }

    public function destroy(int $id, Request $request, int $variavelId)
    {
        $valor = Valor::find($id);

        $valor->ativo = 0;
        $valor->save();

        $request->session()->flash('mensagem', "Valor {$valor->nome} removido com sucesso!");
        return redirect()->route('variavel-show', $variavelId);
    }
}
