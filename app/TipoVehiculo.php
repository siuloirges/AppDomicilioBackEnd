<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoVehiculo extends Model

{
    protected $table = 'tipo_vehiculo';
    use SoftDeletes;

    protected $fillable = [

        'nombre',

    ];

    //
}
