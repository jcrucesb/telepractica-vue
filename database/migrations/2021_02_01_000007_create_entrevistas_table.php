<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('postulacion_id')->unsigned()->nullable();
           
            $table->integer('evaluacion')->nullable()->default(1);
            $table->string('seleccionado')->nullable();
            $table->date('fecha_citacion')->nullable();
            $table->time('hora_citacion')->nullable();
            $table->string('correo_enviado')->nullable();
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
        Schema::dropIfExists('entrevistas');
    }
}
