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
        //
        Comision::create([
            'comisionNombre'=>'Comision1-SJCC',
            'comisionHorario'=>'LUN,MAR,MIER',
            'comisionFI'=> '2019-1-1', //date('Y-m-d','now') ,
            'comisionFF'=>'2020-1-1',  //dateTimeThisYear('now', null) ,
            'cursoId'=> 1 ,
        ]);
        Comision::create([
            'comisionNombre'=>'Comision2-SJCC',
            'comisionHorario'=>'LUN,MIER,VIE',
            'comisionFI'=> '2019-1-1', //date('Y-m-d','now') ,
            'comisionFF'=>'2020-1-1',  //dateTimeThisYear('now', null) ,
            'cursoId'=> 1 ,
        ]);
        Comision::create([
            'comisionNombre'=>'Comision3-SJCC',
            'comisionHorario'=>'LUN,MIER,VIE',
            'comisionFI'=> '2019-1-1', //date('Y-m-d','now') ,
            'comisionFF'=>'2020-1-1',  //dateTimeThisYear('now', null) ,
            'cursoId'=> 1 ,
        ]);
        Comision::create([
            'comisionNombre'=>'Comision4-SJCC',
            'comisionHorario'=>'LUN,MIER,VIE',
            'comisionFI'=> '2019-1-1', //date('Y-m-d','now') ,
            'comisionFF'=>'2020-1-1',  //dateTimeThisYear('now', null) ,
            'cursoId'=> 1 ,
        ]);
        Comision::create([
            'comisionNombre'=>'Comision5-SAC',
            'comisionHorario'=>'VIE',
            'comisionFI'=> '2019-1-4', //date('Y-m-d','now') ,
            'comisionFF'=>'2020-1-4',  //dateTimeThisYear('now', null) ,
            'cursoId'=> 2 ,
        ]);
     
    }
}
