<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome','categoria_pai'];

    public function parent()
    {
        return $this->belongsTo(Categoria::class, 'categoria_pai');
    }

    public function filhas()
    {
        return $this->hasMany(Categoria::class, 'categoria_pai');
    }
}
