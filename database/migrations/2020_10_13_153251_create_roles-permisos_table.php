<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles-permisos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rol_id');

            $table->bigInteger('permiso_id');
            $table->softDeletes();
            $table->timestamps();
            //relaciones
 
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('roles-permisos');
    }
}
