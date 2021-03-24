<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('practicante_id')->unsigned()->nullable();
                      
            $table->string('nombre_exp', 200)->nullable();
            $table->string('descripcion_exp', 200)->nullable();
            $table->string('duracion_exp', 200)->nullable();
            $table->string('actividades_exp', 200)->nullable();
            
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
        Schema::dropIfExists('experiencias');
    }
}
