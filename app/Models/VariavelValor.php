<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariavelValor extends Model
{
    use HasFactory;

    protected $table = 'variavel_valores';
    protected $fillable = ['variavel_id', 'valor_id'];

    public function variavel()
    {
        return $this->belongsTo(Variavel::class);
    }

    public function valor()
    {
        return $this->belongsTo(Valor::class);
    }
    
}
