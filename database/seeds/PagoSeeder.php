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

        Pago::create([
            'pagoAbono' => 1350,
            'pagoFAbono' =>  '2019-07-01',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        $cuota = Cuota::find(2);
        Pago::create([
            'pagoAbono' => 400,
            'pagoFAbono' =>  '2019-07-01',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        Pago::create([
            'pagoAbono' => 450,
            'pagoFAbono' =>  '2019-07-01',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
        $cuota = Cuota::find(3);
        Pago::create([
            'pagoAbono' => 400,
            'pagoFAbono' =>  '2019-07-01',
            'cuotaId' =>  $cuota->cuotaId,
        ]);
    }
}
