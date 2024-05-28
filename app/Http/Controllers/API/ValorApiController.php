<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ValorResource;
use App\Models\VariavelValor;
use Illuminate\Http\Request;

class ValorApiController extends Controller
{
    public function index()
    {
        $valores = VariavelValor::query()
            ->select('variavel_valores.id', 'variavel_valores.variavel_id', 'variavel_valores.valor_id')
            ->leftJoin('valores', 'valores.id', 'variavel_valores.valor_id')
            ->leftJoin('regioes', 'regioes.id', 'valores.regiao_id')
            ->orderBy('regioes.nome', 'ASC')
            ->get();

        return ValorResource::collection($valores);
    }

    public function show(int $variavel_id)
    {
        $valor = VariavelValor::query()
            ->select('variavel_valores.id', 'variavel_valores.variavel_id', 'variavel_valores.valor_id')
            ->leftJoin('valores', 'valores.id', 'variavel_valores.valor_id')
            ->leftJoin('regioes', 'regioes.id', 'valores.regiao_id')
            ->orderBy('regioes.nome', 'ASC')
            ->where('variavel_valores.variavel_id', '=', $variavel_id)
            ->get();

        return ValorResource::collection($valor);
    }
}
