<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndicadorResource;
use App\Models\Indicador;
use Illuminate\Http\Request;

class IndicadorApiController extends Controller
{

/**
    * @OA\Get(
    *      path="/indicadores",
    *      tags={"Indicadores"},
    *      summary="Pega Todos Indicadores",
    *      description="Retorna a lista de todos Indicadores existentes na base",
    *      @OA\Parameter(
    *          name="id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Sucesso",
    *          @OA\JsonContent(
    *              @OA\Examples(
    *                  example="result",
    *                  value={
    *                          "id": "integer",
    *                          "nome": "string",
    *                          "imagem": "string",
    *                          "nota_tecnica": "string",
    *                          "observacao": "string",
    *                          "projeto_id": "integer",
    *                          "projeto": "string",
    *                          "fonte": {
    *                              "id": "integer",
    *                              "nome": "string",
    *                              "descricao": "string",
    *                          },
    *                          "departamento": {
    *                              "id": "integer",
    *                              "sigla": "string",
    *                              "nome": "string",
    *                          },
    *                          "periodicidade": "string",
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
    public function index(Request $request)
    {
        $indicadores = Indicador::query()
            ->select('indicadores.id', 'indicadores.nome', 'indicadores.observacao', 'indicadores.imagem', 'indicadores.nota_tecnica', 'indicadores.departamento_id', 'indicadores.fonte_id', 'indicadores.periodicidade_id', 'indicadores.projeto_id')
            ->leftJoin('departamentos', 'departamentos.id', 'indicadores.departamento_id')
            ->leftJoin('fontes', 'fontes.id', 'indicadores.fonte_id')
            ->leftJoin('projetos', 'projetos.id', 'indicadores.projeto_id')
            ->leftJoin('periodicidades', 'periodicidades.id', 'indicadores.periodicidade_id')
            ->where('indicadores.ativo', '=', 1)
            ->paginate(10);


        return IndicadorResource::collection($indicadores);
    }

    /**
    * @OA\Get(
    *      path="/indicadores/{id}",
    *      tags={"Indicadores"},
    *      summary="Pega a lista de Indicadores",
    *      description="Retorna a lista de Indicadores",
    *      @OA\Parameter(
    *          name="id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Sucesso",
    *          @OA\JsonContent(
    *              @OA\Examples(
    *                  example="result",
    *                  value={
    *                          "id": "integer",
    *                          "nome": "string",
    *                          "imagem": "string",
    *                          "nota_tecnica": "string",
    *                          "observacao": "string",
    *                          "projeto_id": "integer",
    *                          "projeto": "string",
    *                          "fonte": {
    *                              "id": "integer",
    *                              "nome": "string",
    *                              "descricao": "string",
    *                          },
    *                          "departamento": {
    *                              "id": "integer",
    *                              "sigla": "string",
    *                              "nome": "string",
    *                          },
    *                          "periodicidade": "string",
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
    public function show(Request $request, int $projeto_id)
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
/**
    * @OA\Get(
    *      path="/indicador/{id}",
    *      tags={"Indicadores"},
    *      summary="Pega Indicador",
    *      description="Retorna o Indicador com o Id especificado",
    *      @OA\Parameter(
    *          name="id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Sucesso",
    *          @OA\JsonContent(
    *              @OA\Examples(
    *                  example="result",
    *                  value={
    *                          "id": "integer",
    *                          "nome": "string",
    *                          "imagem": "string",
    *                          "nota_tecnica": "string",
    *                          "observacao": "string",
    *                          "projeto_id": "integer",
    *                          "projeto": "string",
    *                          "fonte": {
    *                              "id": "integer",
    *                              "nome": "string",
    *                              "descricao": "string",
    *                          },
    *                          "departamento": {
    *                              "id": "integer",
    *                              "sigla": "string",
    *                              "nome": "string",
    *                          },
    *                          "periodicidade": "string",
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


    public function getIndicador(Request $request, int $id)
    {
        $indicador = Indicador::with('departamento', 'fonte', 'projeto', 'periodicidade')->findOrFail($id);

        if($indicador == null) {
            return response()->json([
                'mensagem' => 'Indicador naõ encontrado!',
            ], 404);
        }
        return new IndicadorResource($indicador);
    }
}
