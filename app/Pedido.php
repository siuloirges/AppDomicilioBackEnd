<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model

//protected $table = 'tipo_documentos';



{
    protected $table = 'pedidos';
    use SoftDeletes;

    protected $fillable = [

        //datos
        'estado',
        "generada",
        "autorizada",
        "preparada",
        "en_transito",
        "entregada",
        "cancelada",

        'numero_pedido',
        'metodo_de_pago',
        'precio_total',
        'motivo_anulacion',

        //relaciones
        'aliado_id',
        'sucursal_id',

        'direccion_id',
        'cliente_id',
        'repartidor_id'

    ];
    public function aliado(){

        return $this->belongsTo(Aliado::class,'aliado_id');
    }

    public function direccion(){

        return $this->belongsTo(Direccion::class,'direccion_id');
    }

    public function sucursal(){

        return $this->belongsTo(Sucursales::class,'sucursal_id');
    }

    public function cliente(){

        return $this->belongsTo(Usuario::class,'cliente_id');
    }
}
