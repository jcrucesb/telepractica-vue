<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoPracticantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_practicantes', function (Blueprint $table) {
            $table->id();
            $table->integer('practicante_id')->unsigned()->nullable();
            $table->string('nombreCurso')->nullable();
            $table->string('nombreProfesionalCurso')->nullable();
            $table->integer('duracionMesesCurso')->nullable();
            $table->integer('duracionHorasCurso')->nullable();
            $table->string('certificacion')->nullable();
            $table->string('rutaArchivo')->nullable();
            $table->foreign('practicante_id')->references('id')->on('practicantes');
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
        Schema::dropIfExists('certificado_practicantes');
    }
}
