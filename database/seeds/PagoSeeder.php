<?php

use Illuminate\Database\Seeder;
use App\Pago;
use App\Cuota;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cuota = Cuota::find(1);
        //inscripcion
        Pago::create([
            'pagoAbono' => 1350,
            'pagoFAbono' =>  '2019-01-01',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        $cuota = Cuota::find(2);
        // // cuota 1 en dos pagos
        Pago::create([
            'pagoAbono' => 400,
            'pagoFAbono' =>  '2019-01-02',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        Pago::create([
            'pagoAbono' => 300,
            'pagoFAbono' =>  '2019-01-13',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        Pago::create([
            'pagoAbono' => 150,
            'pagoFAbono' =>  '2019-01-15',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        $cuota = Cuota::find(3);
        // cuota 2 , pagada
        Pago::create([
            'pagoAbono' => 850,
            'pagoFAbono' =>  '2019-02-11',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        $cuota = Cuota::find(4);
        // cuota 3, pagada
        Pago::create([
            'pagoAbono' => 450,
            'pagoFAbono' =>  '2019-03-05',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        // $cuota = Cuota::find(5);
        // // cuota 4 , pago parcial
        // Pago::create([
        //     'pagoAbono' => 450,
        //     'pagoFAbono' =>  '2019-04-11',
        //     'cuotaId' =>  $cuota->cuotaId,
        // ]);
    }
}
