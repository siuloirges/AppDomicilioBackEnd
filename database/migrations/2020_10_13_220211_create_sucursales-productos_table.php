<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalesProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales-productos', function (Blueprint $table) {

            $table->bigIncrements('id');



            $table->softDeletes();
            $table->timestamps();
            //relaciones
            $table->string('id_sucursal');
            $table->string('id_producto');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursales-productos');
    }
}
