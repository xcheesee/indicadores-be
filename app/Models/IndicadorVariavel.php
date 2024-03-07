<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorVariavel extends Model
{
    use HasFactory;

    protected $table = 'indicador_variaveis';
    protected $fillable = ['indicador_id', 'variavel_id'];

    public function indicador()
    {
        return $this->belongsTo(Indicador::class);
    }

    public function variavel()
    {
        return $this->belongsTo(Variavel::class);
    }   
}
