<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AliadosCategorias extends Model
{
    use SoftDeletes;
    protected $table = 'aliado-categorias';

    protected $fillable = [
        'estado',
        'id_aliado',
        'id_categoria'
    ];


    public function aliado(){

        $aliado = $this->belongsTo(Aliado::class,'id_aliado')->with('sucursales');

        return $aliado;

    }
    public function sucursales(){

//        $sucursales = Sucursales:

//        return $sucursales;

    }

}
