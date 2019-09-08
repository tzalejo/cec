<?php

use Illuminate\Database\Seeder;
use App\Materia;
class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Materia::create([
            'materiaNombre'=>'Informatica',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Contabilidad',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Dactilografia',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Lengua',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Estadistica',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Sistema Contable',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Legislatura',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Virus Informatico',
            'materiaSeminario'=>true,
        ]);
        Materia::create([
            'materiaNombre'=>'Seremonial y Protocolo',
            'materiaSeminario'=>true,
        ]);
        Materia::create([
            'materiaNombre'=>'HTML',
            'materiaSeminario'=>true,
        ]);
        Materia::create([
            'materiaNombre'=>'Sistema Informatico',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Base de Datos',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Programacion',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Historia',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Dibujo 3D',
            'materiaSeminario'=>false,
        ]);
        Materia::create([
            'materiaNombre'=>'Sistema Contable 2',
            'materiaSeminario'=>false,
        ]);

    }
}
