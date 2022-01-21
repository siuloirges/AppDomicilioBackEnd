<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categorias';

    protected $fillable = [
        'titulo',
        'descripcion',
        'url_imagen',
    ];


//    public function aliadosConCategorias(){
//
//        return $this->belongsTo(aliadoCaategoria::class,'id');
//    }
}
