<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Venda extends Model
{
    protected $fillable = [
        'cliente_id',
        'endereco_id',
        'valor_total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produto_venda')
            ->withPivot(['quantidade', 'subtotal'])
            ->withTimestamps();
    }
}