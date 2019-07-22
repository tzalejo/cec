<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaEstudiantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('estudianteId');
            $table->string('estudianteDNI',8);
            $table->string('estudianteApellido',50);
            $table->string('estudianteNombre',50);
            $table->string('estudianteDomicilio',100);
            $table->string('estudianteTelefono',50);
            $table->string('estudianteLocalidad',100);
            $table->date('estudianteNacimiento');
            $table->string('estudianteFoto');
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
        Schema::dropIfExists('estudiantes');
    }
}
