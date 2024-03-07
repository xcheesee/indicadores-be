<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    use HasFactory;

    protected $table = 'valores';
    protected $fillable = ['nome', 'regiao_id', 'periodo', 'valor', 'ativo'];

    public function regiao()
    {
        return $this->belongsTo(Regiao::class);
    }
}
