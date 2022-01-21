<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Usuario extends Authenticatable
{
use HasApiTokens,Notifiable;

    protected $table = 'users';

    use SoftDeletes;
    protected $fillable = [

        'nombre',
        'numero_documento',
        'telefono',
        'email',
        'url_foto_perfil',

        //Firebase Cloud Messaging Token
        'fcm_token',

        //repartidor
        'placa_vehiculo',
        'foto_documento_identidad_1',
        'foto_documento_identidad_2',
        'foto_targeta_propiedad_1',
        'foto_targeta_propiedad_2',
        'foto_soat_1',
        'foto_soat_2',
        'foto_vehiculo_1',
        'foto_vehiculo_2',
        'rol',

        //relaciones
        'tipo_vehiculo_id',
        'tipo_documento_id',
        'rol_id',
        'id_aliado',
        'id_sucursal',


    ];

    protected $hidden = [
        'password',
    ];
}
