<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aliado extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'razon_social',
        'nit',
        'visible',
        'url_foto_perfil',
        'url_foto_portada'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function sucursales(){

        $aliado = $this->hasMany(Sucursales::class,'id_aliado')->where('estado','!=','no_disponible');

        return $aliado;

    }

}
