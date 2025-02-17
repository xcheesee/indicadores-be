<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonte extends Model
{
    use HasFactory;

    protected $table = 'fontes';
    protected $fillable = ['nome', 'descricao', 'ativo'];
}
