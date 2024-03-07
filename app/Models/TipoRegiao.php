<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRegiao extends Model
{
    use HasFactory;

    protected $table = 'tipo_regioes';
    protected $fillable = ['nome', 'sigla', 'ativo'];
    
}
