<?php

use Illuminate\Database\Seeder;
use App\Comision;

class ComisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // comision inactivas
        Comision::create([
            'comisionNombre'=>'Comision 1',
            'comisionHorario'=>'LUN,MAR,MIER',
            'comisionFI'=> '2019-1-1', //date('Y-m-d','now') ,
            'comisionFF'=>'2020-1-1',  //dateTimeThisYear('now', null) ,
            'cursoId'=> 1 ,
        ]);
        // Comision::create([
        //     'comisionNombre'=>'Comision 2',
        //     'comisionHorario'=>'LUN,MIER,VIE',
        //     'comisionFI'=> '2020-1-1', //date('Y-m-d','now') ,
        //     'comisionFF'=>'2021-1-1',  //dateTimeThisYear('now', null) ,
        //     'cursoId'=> 1 ,
        // ]);
        // Comision::create([
        //     'comisionNombre'=>'Comision 3',
        //     'comisionHorario'=>'LUN,MIER,VIE',
        //     'comisionFI'=> '2020-1-1', //date('Y-m-d','now') ,
        //     'comisionFF'=>'2021-1-1',  //dateTimeThisYear('now', null) ,
        //     'cursoId'=> 1 ,
        // ]);
        // Comision::create([
        //     'comisionNombre'=>'Comision 4',
        //     'comisionHorario'=>'LUN,MIER,VIE',
        //     'comisionFI'=> '2020-1-1', //date('Y-m-d','now') ,
        //     'comisionFF'=>'2021-1-1',  //dateTimeThisYear('now', null) ,
        //     'cursoId'=> 1 ,
        // ]);
        // Comision::create([
        //     'comisionNombre'=>'Comision 5',
        //     'comisionHorario'=>'VIE',
        //     'comisionFI'=> '2020-1-4', //date('Y-m-d','now') ,
        //     'comisionFF'=>'2020-5-4',  //dateTimeThisYear('now', null) ,
        //     'cursoId'=> 2 ,
        // ]);

        factory(Comision::class)->times(15)->create();
    }
}
