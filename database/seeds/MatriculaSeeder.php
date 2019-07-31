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
    public function run(){
        // Recordar: regular(RE), no regular(NR) o egresado(EG) 
        Matricula::create([
            'matriculaSituacion'=>'NR',
            'estudianteId'=>1 ,
            'comisionId'=>1 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>2 ,
            'comisionId'=>1 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>3 ,
            'comisionId'=>1 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>4 ,
            'comisionId'=>1 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>5 ,
            'comisionId'=>1 ,
        ]);
        // comision 2
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>6 ,
            'comisionId'=>2 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>7 ,
            'comisionId'=>2 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>8 ,
            'comisionId'=>2 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>9 ,
            'comisionId'=>2 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 10,
            'comisionId'=>2 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 11,
            'comisionId'=>2 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 12,
            'comisionId'=>2 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 13,
            'comisionId'=>3 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 14,
            'comisionId'=>3 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 15,
            'comisionId'=>3 ,
        ]);
        //comision 5
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 16,
            'comisionId'=>5 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 17,
            'comisionId'=>5 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 18,
            'comisionId'=>5 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 19,
            'comisionId'=>5 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 20,
            'comisionId'=>5 ,
        ]);
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=> 21,
            'comisionId'=>5 ,
        ]);

        

    }
}
