<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluacionRepartidor extends Model
{
    protected $table = 'evaluacion_repartidors';
    use SoftDeletes;
    protected $fillable = [

        "id_repartidor",
        "id_cliente",
        "value",
        "descripcion"

    ];
}
