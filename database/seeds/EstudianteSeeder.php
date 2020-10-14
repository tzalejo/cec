<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Estudiante;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creo 20 estudiantes aleatorios..
        factory(Estudiante::class)->times(10)->create();
    }
}
