<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjetoResource;
use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoApiController extends Controller
{
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
