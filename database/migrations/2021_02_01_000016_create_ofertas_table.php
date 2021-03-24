<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('empresa_id')->unsigned()->nullable();
            $table->bigInteger('estado_oferta_id')->unsigned()->nullable();
            $table->bigInteger('supervisor_id')->unsigned()->nullable();
            
            $table->string('nombre_oferta', 200)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->boolean('remunerada')->nullable();
            $table->string('fecha_inicio', 200)->nullable();
            $table->string('fecha_termino', 200)->nullable();
            $table->string('requisitos_min', 200)->nullable();
            $table->integer('cupos_totales')->nullable();
            $table->integer('postulaciones_recibidas')->nullable();
            
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
        Schema::dropIfExists('ofertas');
    }
}
