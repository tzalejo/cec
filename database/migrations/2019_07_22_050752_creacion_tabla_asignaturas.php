<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaAsignaturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->bigIncrements('asignaturasId');
            $table->timestamps();

            $table->unsignedInteger('cursoId');
            $table->foreign('cursoId')->references('cursoId')->on('cursos');
            
            $table->unsignedInteger('materiaId');
            $table->foreign('materiaId')->references('materiaId')->on('materias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignaturas');
    }
}
