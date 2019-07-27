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
            $table->string('estudianteDNI',9);
            $table->string('estudianteApellido',50);
            $table->string('estudianteNombre',50);
            $table->string('estudianteDomicilio',100);
            $table->string('estudianteTelefono',50)->nullable();
            $table->string('estudianteLocalidad',100);
            $table->string('estudianteEmail',100)->nullable();;
            $table->date('estudianteNacimiento');
            $table->string('estudianteFoto')->nullable();
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
        Schema::dropIfExists('estudiantes');
    }
}
