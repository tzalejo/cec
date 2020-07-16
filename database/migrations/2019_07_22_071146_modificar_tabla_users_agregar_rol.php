<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarTablaUsersAgregarRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // agrego la relacion
            $table->unsignedBigInteger('roleId');
            $table->foreign('roleId')->references('roleId')->on('roles');
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
            // elimino primero clave foranea
            $table->dropForeign(['roleId']);
            $table->dropColumn('roleId');
        });
    }
}
