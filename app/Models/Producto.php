<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'precio',
        'unidad',
        'stock',
        'imagen',
        'destacado',
        'activo'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'destacado' => 'boolean',
        'activo' => 'boolean'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function itemsCarrito()
    {
        return $this->hasMany(ItemCarrito::class);
    }

    public function itemsPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
