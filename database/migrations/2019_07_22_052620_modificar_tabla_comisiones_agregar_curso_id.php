<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarTablaComisionesAgregarCursoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comisiones', function (Blueprint $table) {
            // forekey cursos
            $table->unsignedBigInteger('cursoId');
            $table->foreign('cursoId')->references('cursoId')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comisiones', function (Blueprint $table) {
            // elimino primero clave foranea
            $table->dropForeign(['cursoId']);
            $table->dropColumn('cursoId');
        });
    }
}
