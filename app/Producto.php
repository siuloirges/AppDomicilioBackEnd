<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    protected $table = 'productos';
    use SoftDeletes;
    protected $fillable = [


        'url_imagen_producto',
        'titulo',
        'codigo',
        'descripcion',
        'precio',
        'disponibilidad',
        'is_combo',
        'is_promo',
        'precio_promo',
        'descripcion_promo',
        'id_aliado',
        'id_categoria_producto',





    ];



}
