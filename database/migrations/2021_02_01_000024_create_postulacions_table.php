<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulacions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('oferta_id')->unsigned()->nullable();
            $table->bigInteger('practicante_id')->unsigned()->nullable();
            
            $table->bigInteger('estado_post_id')->unsigned()->nullable();
           
            $table->string('nombre', 200)->nullable();
            $table->string('fecha', 200)->nullable();
            $table->string('hora', 200)->nullable();

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
        Schema::dropIfExists('postulacions');
    }
}
