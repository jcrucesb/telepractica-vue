<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carreras', function (Blueprint $table) {
            $table->foreign('escuela_id')->references('id')->on('escuelas')->onDelete('cascade');
            $table->foreign('mencion_id')->references('id')->on('mencions')->onDelete('cascade');
        });

        Schema::table('comunas', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });

        Schema::table('cursos', function (Blueprint $table) {
            $table->foreign('practicante_id')->references('id')->on('practicantes')->onDelete('cascade');
        });

        Schema::table('empresas', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('entrevistas', function (Blueprint $table) {
            $table->foreign('postulacion_id')->references('id')->on('postulacions')->onDelete('cascade');
        });

        Schema::table('escuelas', function (Blueprint $table) {
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
        });

        Schema::table('experiencias', function (Blueprint $table) {
            $table->foreign('practicante_id')->references('id')->on('practicantes')->onDelete('cascade');
        });

        Schema::table('ofertas', function (Blueprint $table) {
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('estado_oferta_id')->references('id')->on('estado_ofertas')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
        });

        Schema::table('practicantes', function (Blueprint $table) {
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
            $table->foreign('comuna_id')->references('id')->on('comunas')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('institucions')->onDelete('cascade');
            $table->foreign('nivel_educacional_id')->references('id')->on('nivel_educacionals')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('tipo_practica_id')->references('id')->on('tipo_practicas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('supervisors', function (Blueprint $table) {
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });

        Schema::table('institucions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('institucion_carreras', function (Blueprint $table) {
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('institucions')->onDelete('cascade');
        });

        Schema::table('postulacions', function (Blueprint $table) {
            $table->foreign('oferta_id')->references('id')->on('ofertas')->onDelete('cascade');
            $table->foreign('practicante_id')->references('id')->on('practicantes')->onDelete('cascade');
        });

        Schema::table('oferta_carreras', function (Blueprint $table) {
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
            $table->foreign('oferta_id')->references('id')->on('ofertas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
