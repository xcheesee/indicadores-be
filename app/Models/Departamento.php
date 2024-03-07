<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $fillable = ['nome', 'sigla', 'ativo'];
    
    public function projeto()
    {
        return $this->hasMany(Projeto::class);
    }
}
