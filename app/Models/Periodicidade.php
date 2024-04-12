<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodicidade extends Model
{
    use HasFactory;

    protected $table = 'periodicidades';
    protected $fillable = ['nome', 'qtd_meses', 'ativo'];
}
