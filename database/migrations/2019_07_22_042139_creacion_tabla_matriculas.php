<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaMatriculas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->bigIncrements('matriculaId');
            //Este atributo representa la situación del alumno si es alumno regular(RE), no regular(NR) o egresado(EG).
            $table->string('matriculaSituacion', 2);
            // $table->timestamps();
            $table->unsignedInteger('estudianteId');
            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}
