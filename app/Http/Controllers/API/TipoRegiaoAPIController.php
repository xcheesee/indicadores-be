<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TipoRegiaoResource;
use App\Models\TipoRegiao;
use Illuminate\Http\Request;

class TipoRegiaoAPIController extends Controller
{
    /**
    * @OA\Get(
    *      path="/tipo_regioes",
    *      tags={"Tipo de Regiões"},
    *      summary="Traz a lista dos tipos de regiões cadastradas no sistema",
    *      description="Retorna uma lista dos tipos de regiões",
    *      @OA\Response(
    *          response=200,
    *          description="Sucesso",
    *          @OA\JsonContent(
    *              @OA\Examples(
    *                  example="result",
    *                  value={
    *                          {
    *                              "id": "integer",
    *                              "nome": "string",
    *                              "sigla": "string",
    *                              "ativo": "boolean",
    *                          },
    *                          {
    *                              "id": "integer",
    *                              "nome": "string",
    *                              "sigla": "string",
    *                              "ativo": "boolean",
    *                          },
    *                  },
    *                  summary="Um exemplo de resultado"
    *              ),
    *          )
    *       ),
    *      @OA\Response(
    *          response=404,
    *          description="Não Encontrado"
    *      )
    *     )
    */
    public function index()
    {
        $tipo_regioes = TipoRegiao::query()
            ->select('tipo_regioes.*')
            ->get();

        return TipoRegiaoResource::collection($tipo_regioes);
    }
}
