<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function vendas()
{
    return $this->belongsToMany(Venda::class, 'produto_venda')
                ->withPivot(['quantidade','subtotal'])
                ->withTimestamps();
}
protected $fillable = [
    'nome','descricao','estoque','slug','valor','categoria_id'
  ];

  public function categoria()
  {
      return $this->belongsTo(Categoria::class);
  }

  public function fotos()
  {
      return $this->hasMany(Foto::class);
  }
}

