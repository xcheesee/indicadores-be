<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ValorResource;
use App\Models\VariavelValor;
use Illuminate\Http\Request;

class ValorApiController extends Controller
{
    /**
    * @OA\Get(
    *      path="/valores",
    *      tags={"Valores"},
    *      summary="Traz a lista de todos os Valores cadastrados nas variáveis",
    *      description="Retorna a lista de Valores",
    *      @OA\Response(
    *          response=200,
    *          description="Sucesso",
    *          @OA\JsonContent(
    *              @OA\Examples(
    *                  example="result",
    *                  value={
    *                          {
    *                              "id": "integer",
    *                              "regiao": {
    *                                  "id": "integer",
    *                                  "nome": "string",
    *                                  "sigla": "string",
    *                                  "tipo_regiao_id": "integer",
    *                                  "tipo_regiao": "string",
    *                              },
    *                              "periodo": "string",
    *                              "categoria": "string",
    *                              "valor": "string",
    *                          },
    *                          {
    *                              "id": "integer",
    *                              "regiao": {
    *                                  "id": "integer",
    *                                  "nome": "string",
    *                                  "sigla": "string",
    *                                  "tipo_regiao_id": "integer",
    *                                  "tipo_regiao": "string",
    *                              },
    *                              "periodo": "string",
    *                              "categoria": "string",
    *                              "valor": "string",
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
        $valores = VariavelValor::query()
            ->select('variavel_valores.id', 'variavel_valores.variavel_id', 'variavel_valores.valor_id')
            ->leftJoin('valores', 'valores.id', 'variavel_valores.valor_id')
            ->leftJoin('regioes', 'regioes.id', 'valores.regiao_id')
            ->orderBy('regioes.nome', 'ASC')
            ->get();

        // $periodo = array();
        // $array_valores = array();
        // for ($i = 0; $i < count($valores); ++$i){

        //     $valor_periodo = $valores[$i]['valor']['periodo'];

        //     if(in_array($valor_periodo, $periodo) == false){
        //         array_push($periodo, $valor_periodo);
        //     }

        //     $valor = $valores[$i]['valor']['valor'];
        //     array_push($array_valores, $valor);

        // }

        return ValorResource::collection($valores);
    }

    /**
    * @OA\Get(
    *      path="/variavel/{variavel_id}/valores",
    *      tags={"Valores"},
    *      summary="Traz a lista de valores de uma variável",
    *      description="Retorna a lista de Valores da variável",
    *      @OA\Parameter(
    *          name="variavel_id",
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
    *                          "data":{
    *                           {
    *                               "id": "integer",
    *                               "regiao": {
    *                                   "id": "integer",
    *                                   "nome": "string",
    *                                   "sigla": "string",
    *                                   "tipo_regiao_id": "integer",
    *                                   "tipo_regiao": "string",
    *                               },
    *                               "periodo": "string",
    *                               "categoria": "string",
    *                               "valor": "string",
    *                           },
    *                           {
    *                               "id": "integer",
    *                               "regiao": {
    *                                   "id": "integer",
    *                                   "nome": "string",
    *                                   "sigla": "string",
    *                                   "tipo_regiao_id": "integer",
    *                                   "tipo_regiao": "string",
    *                               },
    *                               "periodo": "string",
    *                               "categoria": "string",
    *                               "valor": "string",
    *                           },
    *                          },
    *                          "periodo": {"string", "string"},
    *                          "valores": {"integer", "integer"},
    *                          "regioes": {"string", "string"},
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
    public function show(int $variavel_id)
    {
        $valor = VariavelValor::query()
            ->select('variavel_valores.id', 'variavel_valores.variavel_id', 'variavel_valores.valor_id')
            ->leftJoin('valores', 'valores.id', 'variavel_valores.valor_id')
            ->leftJoin('regioes', 'regioes.id', 'valores.regiao_id')
            ->leftJoin('tipo_regioes', 'tipo_regioes.id', 'regioes.tipo_regiao_id')
            ->orderBy('valores.periodo', 'ASC')
            ->orderBy('regioes.nome', 'ASC')
            ->where('variavel_valores.variavel_id', '=', $variavel_id)
            ->get();

        $periodo = array();
        $array_valores = array();
        $regioes = array();
        for ($i = 0; $i < count($valor); ++$i){

            $valor_periodo = $valor[$i]['valor']['periodo'];
            $valor_regiao = $valor[$i]['valor']['regiao']['nome'];

            if(in_array($valor_periodo, $periodo) == false){
                array_push($periodo, $valor_periodo);
            }

            $valores = $valor[$i]['valor']['valor'];
            array_push($array_valores, $valores);

            if(in_array($valor_regiao, $regioes) == false){
                array_push($regioes, $valor_regiao);
            }

        }

        return ValorResource::collection($valor)->additional(['periodo'=>$periodo, 'valores'=>$array_valores, 'regioes'=>$regioes]);
    }
}
