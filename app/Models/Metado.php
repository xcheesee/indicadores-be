<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metado extends Model
{
    use HasFactory;

    protected $table = 'metados';
    protected $fillable = ['nome', 'tipo_medida_id', 'serie_historica_inicio', 'serie_historica_fim',
                            'serie_historica_ativo', 'nota_tecnica', 'organizacao', 'observacao', 'ativo'];

    public function tipo_medida()
    {
        return $this->belongsTo(TipoMedida::class);
    }
}
