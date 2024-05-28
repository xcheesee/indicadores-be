<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ValorResource extends JsonResource
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
            // 'id' => $this->id,
            // 'variavel_id' => $this->variavel_id,
            // 'valor_id' => $this->valor_id,
            'id' => $this->valor_id,
            // 'regiao_id' => $this->valor->regiao_id,
            'regiao' => [
                'id' => $this->valor->regiao_id,
                'nome' => $this->valor->regiao->nome,
                'sigla' => $this->valor->regiao->sigla,
            ],
            'periodo' => $this->valor->periodo,
            'categoria' => $this->valor->categoria,
            'valor' => $this->valor->valor,
        ];
    }
}
