<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class IndicadorResource extends JsonResource
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
            'imagem' => $this->imagem ? Storage::url($this->imagem) : null,
            'nota_tecnica' => $this->nota_tecnica,
            'observacao' => $this->observacao,
            'projeto_id' => $this->projeto_id,
            'projeto' => $this->projeto->nome,
            'fonte' => [
                'id' => $this->fonte->id,
                'nome' => $this->fonte->nome,
                'descricao' => $this->fonte->descricao,
            ],
            'departamento' => [
                'id' => $this->departamento->id,
                'sigla' => $this->departamento->sigla,
                'nome' => $this->departamento->nome,
            ],
            'periodicidade' => $this->periodicidade->nome,
        ];
    }
}
