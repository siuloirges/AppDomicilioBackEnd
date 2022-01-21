<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {

            $table->bigIncrements('id');

            //datos
            $table->String('numero_pedido');
            $table->String('estado')->nullable();
            $table->dateTime('generada')->nullable();
            $table->dateTime('autorizada')->nullable();
            $table->dateTime('preparada')->nullable();
            $table->dateTime('en_transito')->nullable();
            $table->dateTime('entregada')->nullable();
            $table->dateTime('cancelada')->nullable();
            $table->string('metodo_de_pago');
            $table->string('precio_total');
            $table->string('motivo_anulacion')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //relaciones
            $table->bigInteger('aliado_id');
            $table->bigInteger('direccion_id');
            $table->bigInteger('sucursal_id');
            $table->bigInteger('cliente_id');

            $table->bigInteger('repartidor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
