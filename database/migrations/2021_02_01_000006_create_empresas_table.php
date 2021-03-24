<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('area_id')->unsigned()->nullable();

            $table->string('run', 200)->nullable()->unique();
            $table->string('email', 200)->nullable()->unique();
           
            $table->string('razon_social', 200)->nullable()->unique();
            $table->string('nombre_ficticio', 200)->nullable()->unique();
            $table->string('giro', 200)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->string('web', 200)->nullable();
            $table->string('telefono', 200)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('fecha_inicio_actividades', 200)->nullable();

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
        Schema::dropIfExists('empresas');
    }
}
