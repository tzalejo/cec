<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarTablaMatriculasAgregarComisionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriculas', function (Blueprint $table) {
            $table->unsignedBigInteger('comisionId');
            $table->foreign('comisionId')->references('comisionId')->on('comisiones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriculas', function (Blueprint $table) {
            // elimino primero clave foranea
            $table->dropForeign(['comisionId']);
            $table->dropColumn('comisionId');
        });
    }
}
