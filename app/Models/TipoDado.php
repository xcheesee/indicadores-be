<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDado extends Model
{
    use HasFactory;

    protected $table = 'tipo_dados';
    protected $fillable = ['nome', 'ativo'];
    
}
