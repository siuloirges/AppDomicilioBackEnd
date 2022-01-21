<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaSucursales extends Model
{
    protected $table = 'categoria_sucursales';
    use SoftDeletes;

    protected $fillable = [

        'id',
        'nombre',
        'id_sucursal',
        'id_aliado'

    ];
}
