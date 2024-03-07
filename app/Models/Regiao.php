<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    use HasFactory;

    protected $table = 'regioes';
    protected $fillable = ['nome', 'sigla', 'tipo_regiao_id', 'ativo'];

    public function tipo_regiao()
    {
        return $this->belongsTo(TipoRegiao::class);
    }

    public function valor()
    {
        return $this->hasMany(Valor::class);
    }

}
