<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $table = 'projetos';
    protected $fillable = ['nome', 'descricao', 'departamento_id', 'imagem', 'ativo'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function getImagemUrlAttribute()
    {
        if($this->imagem){
            return asset("/storage/".$this->imagem);
        }
    }
}
