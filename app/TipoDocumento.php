<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documentos';
    use SoftDeletes;
//
    protected $fillable = [

        'nombre',

    ];

}

