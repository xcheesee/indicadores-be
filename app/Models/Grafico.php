<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grafico extends Model
{
    use HasFactory;

    protected $table = 'graficos';
    protected $fillable = ['titulo', 'subtitulo', 'tipo_grafico', 'projeto_id', 'indicador_id', 'tipo_medida_id', 'label', 'ativo'];

    public function projeto() 
    {
        return $this->belongsTo(Projeto::class);
    }

    public function indicador()
    {
        return $this->belongsTo(Indicador::class);
    }

    public function tipo_medida()
    {
        return $this->belongsTo(TipoMedida::class);
    }

}
