<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;

    protected $table = 'indicadores';
    protected $fillable = ['nome', 'imagem', 'nota_tecnica', 'observacao', 'formula', 'projeto_id', 'fonte_id', 'departamento_id', 'periodicidade_id', 'ativo'];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

    public function fonte()
    {
        return $this->belongsTo(Fonte::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function periodicidade()
    {
        return $this->belongsTo(Periodicidade::class);
    }

    public function getImagemUrlAttribute()
    {
        if($this->imagem){
            return asset("/storage/".$this->imagem);
        }
    }

}
