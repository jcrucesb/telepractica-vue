<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_entrevistas', function (Blueprint $table) {
            $table->id();
            $table->integer('entrevista_id')->unsigned()->nullable();
            $table->string('rut_confirmacion')->nullable();
            $table->timestamps();
            $table->foreign('entrevista_id')->references('id')->on('entrevistas')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_entrevistas');
    }
}
