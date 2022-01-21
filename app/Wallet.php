<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;



class Wallet extends Model

{

    protected $table = 'wallets';
    use SoftDeletes;

    protected $fillable = [

     "id",
     "saldo_actual",
     "credito_actual",

        //relaciones
     "id_repartidor",

    ];



}
