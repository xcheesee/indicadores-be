<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjetoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'departamento' => [
                'id' => $this->departamento->id,
                'sigla' => $this->departamento->sigla,
                'nome' => $this->departamento->nome,
            ],
            'imagem' => $this->imagem ? Storage::url($this->imagem) : null,
            'visivel' => $this->visivel,
        ];
    }
}
