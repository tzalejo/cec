<?php

use Illuminate\Database\Seeder;
use App\Matricula;

class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recordar: regular(RE), no regular(NR) o egresado(EG)
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>1 ,
            'comisionId'=>1 ,
        ]);

        factory(Matricula::class)->times(40)->create();
    }
}
