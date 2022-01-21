<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExistenciaModel extends Model
{
    protected $table = 'existencia';
    use SoftDeletes;

    protected $fillable = [

        'id_producto',
        'id_categoria',
        'id_sucursal',
        'id_aliado',
        'existencia',
        "nombre"

    ];

    public function producto(){

        return $this->belongsTo(Producto::class,'id_producto');
    }
}
