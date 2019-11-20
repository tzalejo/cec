<?php

use Illuminate\Database\Seeder;
use App\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Curso::create([
            'cursoNombre'=> 'SJCC',
            'cursoNroCuota'=> 12,
            'cursoCostoMes'=> 850,
            'cursoInscripcion'=> 1350,
        ]);
        Curso::create([
            'cursoNombre'=> 'SAC',
            'cursoNroCuota'=> 4,
            'cursoCostoMes'=> 950,
            'cursoInscripcion'=> 1350,
        ]);
        Curso::create([
            'cursoNombre'=> 'Virus Informatico',
            'cursoNroCuota'=> 2,
            'cursoCostoMes'=> 1300,
            'cursoInscripcion'=> 1350,
        ]);
    }
}
