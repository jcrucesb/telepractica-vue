<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumPracticantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_practicantes', function (Blueprint $table) {
            $table->id();
            $table->integer('practicante_id')->unsigned()->nullable();
            $table->string('rutaCurriculum')->nullable();
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
        Schema::dropIfExists('curriculum_practicantes');
    }
}
