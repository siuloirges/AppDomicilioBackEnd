<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoUsuario extends Model
{
    protected $table = 'pedidos-usuarios';
    use SoftDeletes;

    protected $fillable = [

        //relaciones
        'id_usuario',
        'id_pedido',


    ];
    protected $hidden = [

    ];
}
