<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjetoResource;
use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/projetos",
     *      tags={"Projetos"},
     *      summary="Pega a lista de Projetos",
     *      description="Retorna a lista de Projetos",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso",
     *          @OA\JsonContent(
     *              @OA\Examples(
     *                  example="result", 
     *                  value={
     *                              {
     *                                  "id": "integer",
     *                                  "nome": "string",
     *                                  "descricao": "string",
     *                                  "departamento": {
     *                                      "id": "integer",
     *                                      "sigla": "string",
     *                                      "nome": "string",
     *                                  },
     *                                  "imagem": "string",
     *                                  "visivel": "integer",
     *                              },
     *                              {
     *                                  "id": "integer",
     *                                  "nome": "string",
     *                                  "descricao": "string",
     *                                  "departamento": {
     *                                      "id": "integer",
     *                                      "sigla": "string",
     *                                      "nome": "string",
     *                                  },
     *                                  "imagem": "string",
     *                                  "visivel": "integer",
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
    public function index(Request $request)
    {
        $projetos = Projeto::query()
            ->select('projetos.nome', 'projetos.descricao', 'projetos.imagem', 'projetos.visivel', 'projetos.departamento_id', 'projetos.id')
            ->leftJoin('departamentos', 'departamentos.id', 'projetos.departamento_id')
            ->where('projetos.ativo', '=', 1)
            ->paginate(10);


        return ProjetoResource::collection($projetos);
    }
}
