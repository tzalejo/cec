<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaCursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->bigIncrements('cursoId');
            $table->string('cursoNombre', 100);
            $table->smallInteger('cursoNroCuota');
            $table->float('cursoCostoMes', 10, 2);
            $table->float('cursoInscripcion', 10, 2);
            // $table->timestamps();
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
