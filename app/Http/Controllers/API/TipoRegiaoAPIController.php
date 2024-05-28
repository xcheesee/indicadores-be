<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TipoRegiaoResource;
use App\Models\TipoRegiao;
use Illuminate\Http\Request;

class TipoRegiaoAPIController extends Controller
{
    public function index()
    {
        $tipo_regioes = TipoRegiao::query()
            ->select('tipo_regioes.id', 'tipo_regioes.nome', 'tipo_regioes.sigla', 'tipo_regioes.ativo')
            ->get();

        return TipoRegiaoResource::collection($tipo_regioes);
    }
}
