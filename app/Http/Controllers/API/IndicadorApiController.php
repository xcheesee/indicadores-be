<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndicadorResource;
use App\Models\Indicador;
use Illuminate\Http\Request;

class IndicadorApiController extends Controller
{
    public function index(Request $request, int $projeto_id)
    {
        $indicadores = Indicador::query()
            ->select('indicadores.id', 'indicadores.nome', 'indicadores.observacao', 'indicadores.imagem', 'indicadores.nota_tecnica', 'indicadores.departamento_id', 'indicadores.fonte_id', 'indicadores.periodicidade_id', 'indicadores.projeto_id')
            ->leftJoin('departamentos', 'departamentos.id', 'indicadores.departamento_id')
            ->leftJoin('fontes', 'fontes.id', 'indicadores.fonte_id')
            ->leftJoin('projetos', 'projetos.id', 'indicadores.projeto_id')
            ->leftJoin('periodicidades', 'periodicidades.id', 'indicadores.periodicidade_id')
            ->where('indicadores.projeto_id', '=', $projeto_id)
            ->where('indicadores.ativo', '=', 1)
            ->paginate(10);


        return IndicadorResource::collection($indicadores);
    }
}
