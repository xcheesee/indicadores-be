<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variavel extends Model
{
    use HasFactory;

    protected $table = 'variaveis';
    protected $fillable = ['codigo', 'nome', 'departamento_id', 'tipo_dado_id', 'fonte_id', 'metadados_id', 'ativo'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function tipo_dado()
    {
        return $this->belongsTo(TipoDado::class);
    }

    public function fonte()
    {
        return $this->belongsTo(Fonte::class);
    }

    public function metadados()
    {
        return $this->belongsTo(Metadado::class);
    }
}
