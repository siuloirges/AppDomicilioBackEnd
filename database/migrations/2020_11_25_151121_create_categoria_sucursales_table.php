<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_sucursales', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nombre');



            $table->timestamps();
            $table->softDeletes();
            //relaciones
            $table->bigInteger('id_sucursal');
            $table->bigInteger('id_aliado');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_sucursales');
    }
}
