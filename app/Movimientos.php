<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimientos extends Model
{

    protected $table = 'movimientos';
    use SoftDeletes;

    protected $fillable = [

        "id",
        "valor_movimiento",
        "tipo_movimiento",

        //relaciones
        "id_wallet",
        "id_repartidor"

    ];

}
