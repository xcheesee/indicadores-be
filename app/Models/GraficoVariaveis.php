<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraficoVariaveis extends Model
{
    use HasFactory;

    protected $table = 'grafico_variaveis';
    protected $fillable = ['grafico_id', 'variavel_id'];

    public function grafico()
    {
        return $this->belongsTo(Grafico::class);
    }
    
    public function variavel()
    {
        return $this->belongsTo(Variavel::class);
    }
}
