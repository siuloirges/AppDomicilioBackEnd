<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {

            $table->bigIncrements('id');

            //datos
            $table->string('url_imagen_producto')->nullable();
            $table->string('titulo');
            $table->text('codigo')->nullable();
            $table->text('descripcion');
            $table->string('precio');
            $table->boolean('disponibilidad');
//            $table->bigInteger('existencia')->nullable();
            $table->boolean('is_combo')->nullable();
            $table->boolean('is_promo')->nullable();
            $table->string('precio_promo')->nullable();
//            $table->text('descripcion_promo')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //relaciones
            $table->string('id_aliado');
            $table->string('id_categoria_producto');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
