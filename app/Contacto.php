<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'cargo',
        'telefono',
        'email',
        'id_aliado'
    ];
}
