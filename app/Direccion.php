<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{

    protected $table = 'direcciones';
    use SoftDeletes;
    protected $fillable = [
        'id',
        'nombre',
        'latitude',
        'longitude',
        'direccion_id',
        'referencia',
        'usuario_id',
        'tipo_direcion',
    ];
    protected $hidden = [

    ];
}
