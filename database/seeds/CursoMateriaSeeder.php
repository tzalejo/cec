<?php

use Illuminate\Database\Seeder;

class CursoMateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $curso_materia = DB::table('curso_materia')->insert([
            [
            'cursoId' => 1,
            'materiaId' => 1
            ],
            [
            'cursoId' => 1,
            'materiaId' => 2
            ],
            [
            'cursoId' => 1,
            'materiaId' => 3
            ],
            [
            'cursoId' => 1,
            'materiaId' => 4
            ],
            [
            'cursoId' => 1,
            'materiaId' => 5
            ],
            [
            'cursoId' => 1,
            'materiaId' => 6
            ],
            [
            'cursoId' => 1,
            'materiaId' => 7
            ],
            [
            'cursoId' => 1,
            'materiaId' => 8
            ],
            [
            'cursoId' => 1,
            'materiaId' => 9
            ],
            [
            'cursoId' => 2,
            'materiaId' => 1
            ],
            [
            'cursoId' => 2,
            'materiaId' => 2
            ],
            [
            'cursoId' => 2,
            'materiaId' => 3
            ],
            [
            'cursoId' => 2,
            'materiaId' => 4
            ],
            [
            'cursoId' => 2,
            'materiaId' => 5
            ],
            [
            'cursoId' => 2,
            'materiaId' => 6
            ]
        ]);
    }
}
