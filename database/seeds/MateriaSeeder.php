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

    }
}
