<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('direccion');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('estado');
            $table->string('id_asistente')->nullable();
            $table->string('url_foto_perfil')->nullable();
            $table->string('url_foto_portada')->nullable();

            $table->bigInteger('telefono')->nullable();
            $table->softDeletes();
            $table->timestamps();
            //relaciones
            $table->string('id_aliado');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursales');
    }
}
