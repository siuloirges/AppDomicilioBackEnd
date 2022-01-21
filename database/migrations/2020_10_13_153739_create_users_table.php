<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
     /**
      * Run the migrations.
      *
      * @return void
      */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');

             //campos de todos los usuarios
             $table->string('nombre');
             $table->bigInteger('numero_documento');
             $table->bigInteger('telefono');
             $table->text('url_foto_perfil')->nullable();
             $table->string('email');
             $table->string('password');
             $table->softDeletes();

             //campos del repartidor
             $table->text  ('placa_vehiculo')->nullable();
             $table->string('foto_documento_identidad_1')->nullable();
             $table->string('foto_documento_identidad_2')->nullable();
             $table->string('foto_targeta_propiedad_1')->nullable();
             $table->string('foto_targeta_propiedad_2')->nullable();
             $table->string('foto_soat_1')->nullable();
             $table->string('foto_soat_2')->nullable();
             $table->string('foto_vehiculo_1')->nullable();
             $table->string('foto_vehiculo_2')->nullable();
             $table->string('rol');
             $table->string  ('calificacion')->nullable();

             //relaciones
             $table->string('tipo_vehiculo_id')->nullable();
             $table->string('tipo_documento_id');
             $table->bigInteger('rol_id')->nullable();
             $table->string('id_aliado')->nullable();
             $table->bigInteger('id_sucursal')->nullable();
             $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
