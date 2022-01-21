<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursales extends Model
{
    use SoftDeletes;
    protected $table = 'sucursales';
    protected $fillable = [

        'nombre',
        'direccion',
        'latitude',
        'longitude',
        'telefono',
        'id_aliado',
        'estado',
        'url_foto_perfil',
        'url_foto_portada',

    ];
}
