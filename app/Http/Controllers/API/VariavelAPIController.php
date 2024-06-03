<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VariavelResource;
use App\Models\IndicadorVariavel;
use Illuminate\Http\Request;

class VariavelAPIController extends Controller
{   
    /**
    * @OA\Get(
    *      path="/variaveis",
    *      tags={"Variável"},
    *      summary="Traz a lista de Variáveis",
    *      description="Retorna a lista de Variáveis",
    *      @OA\Response(
    *          response=200,
    *          description="Sucesso",
    *          @OA\JsonContent(
    *              @OA\Examples(
    *                  example="result", 
    *                  value={
    *                              {
    *                                  "id": "integer",
    *                                  "indicador_id": "integer",
    *                                  "variavel": {
    *                                      "id": "integer",
    *                                      "codigo": "string",
    *                                      "nome": "string",
    *                                      "departamento": {
    *                                          "id": "integer",
    *                                          "nome": "string",
    *                                          "sigla": "string",
    *                                      },
    *                                     },
    *                                      "tipo_dado": {
    *                                          "id": "integer",
    *                                          "tipo": "string",
    *                                      },
    *                                      "fonte": {
    *                                          "id": "integer",
    *                                          "sigla": "string",
    *                                          "nome": "string",
    *                                      },
    *                                      "metadados": {
    *                                          "id": "integer",
    *                                          "tipo_medida_id": "string",
    *                                          "serie_historica_inicio": "string",
    *                                          "serie_historica_fim": "string",
    *                                          "serie_historica_ativo": "integer",
    *                                          "nota_tecnica": "string",
    *                                          "organizacao": "string",
    *                                          "observação": "string",
    *                                      },
    *                                  },
    *                                  {
    *                                      "id": "integer",
    *                                      "indicador_id": "integer",
    *                                      "variavel": {
    *                                          "id": "integer",
    *                                          "codigo": "string",
    *                                          "nome": "string",
    *                                      "departamento": {
    *                                          "id": "integer",
    *                                          "nome": "string",
    *                                          "sigla": "string",
    *                                      },
    *                                      "tipo_dado": {
    *                                          "id": "integer",
    *                                          "tipo": "string",
    *                                      },
    *                                      "fonte": {
    *                                          "id": "integer",
    *                                          "sigla": "string",
    *                                          "nome": "string",
    *                                      },
    *                                      "metadados": {
    *                                          "id": "integer",
    *                                          "tipo_medida_id": "string",
    *                                          "serie_historica_inicio": "string",
    *                                          "serie_historica_fim": "string",
    *                                          "serie_historica_ativo": "integer",
    *                                          "nota_tecnica": "string",
    *                                          "organizacao": "string",
    *                                          "observação": "string",
    *                                      },
    *                                  },
    *                              },
    *                  }, 
    *                  summary="Um exemplo de resultado",
    *              ),
    *          )
    *       ),
    *      @OA\Response(
    *          response=404,
    *          description="Não Encontrado"
    *      )
    *    )
    */
    public function index()
    {
        $variavel = IndicadorVariavel::query()
            ->select('indicador_variaveis.*')
            ->leftJoin('variaveis', 'variaveis.id', '=', 'indicador_variaveis.variavel_id')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'variaveis.departamento_id')
            ->leftJoin('tipo_dados', 'tipo_dados.id', '=', 'variaveis.tipo_dado_id')
            ->leftJoin('fontes', 'fontes.id', '=', 'variaveis.fonte_id')
            ->leftJoin('metadados', 'metadados.id', '=', 'variaveis.metadados_id')
            ->get();

        return VariavelResource::collection($variavel);
    }

    /**
    * @OA\Get(
    *      path="/indicador/{indicador_id}/variaveis",
    *      tags={"Variável"},
    *      summary="Traz a lista de variáveis de um indicador",
    *      description="Retorna a lista de Variáveis de um indicador",
    *      @OA\Parameter(
    *          name="indicador_id",
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
    *                              {
    *                                  "id": "integer",
    *                                  "indicador_id": "integer",
    *                                  "variavel": {
    *                                      "id": "integer",
    *                                      "codigo": "string",
    *                                      "nome": "string",
    *                                      "departamento": {
    *                                          "id": "integer",
    *                                          "nome": "string",
    *                                          "sigla": "string",
    *                                      },
    *                                      "tipo_dado": {
    *                                          "id": "integer",
    *                                          "tipo": "string",
    *                                      },
    *                                      "fonte": {
    *                                          "id": "integer",
    *                                          "sigla": "string",
    *                                          "nome": "string",
    *                                      },
    *                                      "metadados": {
    *                                          "id": "integer",
    *                                          "tipo_medida_id": "string",
    *                                          "serie_historica_inicio": "string",
    *                                          "serie_historica_fim": "string",
    *                                          "nota_tecnica": "string",
    *                                          "organizacao": "string",
    *                                          "observação": "string",
    *                                      },
    *                                  },
    *                              },
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
    public function show(int $indicador_id)
    {
        $variavel = IndicadorVariavel::query()
            ->select('indicador_variaveis.*')
            ->leftJoin('variaveis', 'variaveis.id', '=', 'indicador_variaveis.variavel_id')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'variaveis.departamento_id')
            ->leftJoin('tipo_dados', 'tipo_dados.id', '=', 'variaveis.tipo_dado_id')
            ->leftJoin('fontes', 'fontes.id', '=', 'variaveis.fonte_id')
            ->leftJoin('metadados', 'metadados.id', '=', 'variaveis.metadados_id')
            ->where('indicador_variaveis.indicador_id', '=', $indicador_id)
            ->get();

        return VariavelResource::collection($variavel);
    }
}
