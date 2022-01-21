<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetallePedido extends Model
{
    protected $table = 'detalle_pedidos';
    use SoftDeletes;

    protected $fillable = [

        'cantidad',
        'id_pedido',
        'id_producto'

    ];

    public function producto(){

        return $this->belongsTo(Producto::class,'id_producto');
    }

}
