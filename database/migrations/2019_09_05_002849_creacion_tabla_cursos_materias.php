<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaCursosMaterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_materia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cursoId')->unsigned();
            $table->integer('materiaId')->unsigned();
            // $table->timestamps();
            $table->unique(['cursoId', 'materiaId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_materia');
    }
}
