<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAliadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aliados', function (Blueprint $table) {
            $table->bigIncrements('id');

            //datos
            $table->string('nombre');
            $table->string('razon_social')->nullable();
            $table->bigInteger('nit');
            $table->string('url_foto_perfil') ->nullable();
            $table->string('url_foto_portada')->nullable();
            $table->boolean('visible');
            $table->softDeletes();
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
        Schema::dropIfExists('aliados');
    }
}
