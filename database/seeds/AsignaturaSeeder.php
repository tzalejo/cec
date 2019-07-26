<?php

use Illuminate\Database\Seeder;
use App\Asignatura;
class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>1,
        ]);
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>2,
        ]);
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>3,
        ]);
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>4,
        ]);
        
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>5,
        ]);
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>6,
        ]);
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>7,
        ]);
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>8,
        ]);
        Asignatura::create([
            'cursoId'=>1,
            'materiaId'=>9,
        ]);
        // sac
        Asignatura::create([
            'cursoId'=>2,
            'materiaId'=>1,
        ]);
        Asignatura::create([
            'cursoId'=>2,
            'materiaId'=>2,
        ]);
        Asignatura::create([
            'cursoId'=>2,
            'materiaId'=>3,
        ]);
        Asignatura::create([
            'cursoId'=>2,
            'materiaId'=>4,
        ]);
        Asignatura::create([
            'cursoId'=>2,
            'materiaId'=>5,
        ]);
        // virus informatico
        Asignatura::create([
            'cursoId'=>3,
            'materiaId'=>1,
        ]);
        Asignatura::create([
            'cursoId'=>3,
            'materiaId'=>8,
        ]);

    }
}
