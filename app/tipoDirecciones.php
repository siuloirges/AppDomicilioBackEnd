<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipoDirecciones extends Model
{
    protected $table = 'tipo_direcciones';
    use SoftDeletes;
//
    protected $fillable = [

        'icono'

    ];
}
