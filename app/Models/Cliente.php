<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'telefone',
        'email',
        'senha',
    ];
    
    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

}