<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('practicante_id')->unsigned()->nullable();
                      
            $table->string('nombre_curs', 200)->nullable();
            $table->string('descripcion_curs', 200)->nullable();
            $table->string('duracion_curs', 200)->nullable();
            $table->string('adjunto_curs', 200)->nullable();
            
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
        Schema::dropIfExists('cursos');
    }
}
