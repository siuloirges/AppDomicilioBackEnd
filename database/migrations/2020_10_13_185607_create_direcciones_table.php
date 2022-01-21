<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {

            $table->bigIncrements('id');
            
            //datos
            $table->string('nombre');
            $table->string('direccion');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('referencia')->nullable();
            $table->string('tipo_direcion_id')->nullable();
            $table->softDeletes();

            //relaciones
            $table->bigInteger('usuario_id');
            $table->timestamps();

//            'altitud',
//            'longitud',
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direcciones');
    }
}
