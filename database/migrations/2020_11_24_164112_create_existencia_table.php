<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_producto');
            $table->string('nombre');
            $table->bigInteger('id_categoria');
            $table->bigInteger('id_sucursal');
            $table->bigInteger('id_aliado');
            $table->string('existencia');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('existencia');
    }
}
