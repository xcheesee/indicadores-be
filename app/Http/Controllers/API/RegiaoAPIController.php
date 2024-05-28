<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegiaoResource;
use App\Models\Regiao;
use Illuminate\Http\Request;

class RegiaoAPIController extends Controller
{
    public function index() 
    {
        $regioes = Regiao::query()
            ->select('regioes.id', 'regioes.nome', 'regioes.sigla', 'regioes.tipo_regiao_id', 'regioes.ativo')
            ->orderBy('regioes.nome', 'ASC')
            ->get();

        return RegiaoResource::collection($regioes);
    }

    public function show(int $tipo_regiao_id)
    {
        $regioes = Regiao::query()
            ->select('regioes.id', 'regioes.nome', 'regioes.sigla', 'regioes.tipo_regiao_id', 'regioes.ativo')
            ->where('regioes.tipo_regiao_id', '=', $tipo_regiao_id)
            ->orderBy('regioes.nome', 'ASC')
            ->get();

        return RegiaoResource::collection($regioes);
    }
}
