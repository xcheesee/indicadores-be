<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariavelResource extends JsonResource
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
            'indicador_id' => $this->indicador_id,
            // 'variavel_id' => $this->variavel_id,
            'variavel' => [
                'id' => $this->variavel_id,
                'codigo' => $this->variavel->codigo,
                'nome' => $this->variavel->nome,
                // 'departamento_id' => $this->variavel->departamento_id,
                'departamento' => [
                    'id' => $this->variavel->departamento_id,
                    'nome' => $this->variavel->departamento->nome,
                    'sigla' => $this->variavel->departamento->sigla,
                ],
                // 'tipo_dado_id' => $this->variavel->tipo_dado_id,
                'tipo_dado' => [
                    'id' => $this->variavel->tipo_dado_id,
                    'tipo' => $this->variavel->tipo_dado->nome,
                ],
                // 'fonte_id' => $this->variavel->fonte_id,
                'fonte' => [
                    'id' => $this->variavel->fonte_id,
                    'sigla' => $this->variavel->fonte->nome,
                    'nome' => $this->variavel->fonte->descricao
                ],
                // 'metadados_id' => $this->variavel->metadados_id,
                'metadados' => [
                    'id' => $this->variavel->metadados_id,
                    'tipo_medida_id' => $this->variavel->metadados->tipo_medida_id,
                    'serie_historica_inicio' => $this->variavel->metadados->serie_historica_inicio,
                    'serie_historica_fim' => $this->variavel->metadados->serie_historica_fim,
                    'serie_historica_ativo' => $this->variavel->metadados->serie_historica_ativo,
                    'nota_tecnica' => $this->variavel->metadados->nota_tecnica,
                    'organizacao' => $this->variavel->metadados->organizacao,
                    'observacao' => $this->variavel->metadados->observacao,
                ]
            ]
        ];
    }
}
