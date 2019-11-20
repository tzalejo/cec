<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaCuotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->bigIncrements('cuotaId');
            $table->string('cuotaConcepto', 100);
            $table->float('cuotaMonto', 10, 2);
            $table->date('cuotaFVencimiento');
            $table->float('cuotaBonificacion', 10, 2)->default(0.0);
            // $table->timestamps();

            $table->unsignedInteger('matriculaId');
            $table->foreign('matriculaId')->references('matriculaId')->on('matriculas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuotas');
    }
}
