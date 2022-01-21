<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('valor_movimiento');
            $table->string('tipo_movimiento');
            $table->timestamps();
            $table->softDeletes();
            //relaciones
            $table->string('id_wallet');
            $table->string('id_repartidor');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
