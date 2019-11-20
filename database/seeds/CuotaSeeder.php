<?php

use Illuminate\Database\Seeder;
use App\Cuota;
use App\Matricula;

class CuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matricula = Matricula::find(1);

        // generar las cuotas de la matricula..
        $nuevafecha = $matricula->comision->comisionFI;
        Cuota::create([
            'cuotaConcepto' => 'Inscripcion - '.$matricula->comision->curso->cursoNombre,
            'cuotaMonto' => $matricula->comision->curso->cursoInscripcion,
            'cuotaFVencimiento' => $nuevafecha,
            'cuotaBonificacion' => 0,
            'matriculaId' => $matricula->matriculaId,
            ]);
        for ($i=1; $i <= $matricula->comision->curso->cursoNroCuota ; $i++) {
            # code...
            Cuota::create([
                'cuotaConcepto' => 'Cuota '.$i.' - '.$matricula->comision->curso->cursoNombre,
                'cuotaMonto' => $matricula->comision->curso->cursoCostoMes,
                'cuotaFVencimiento' => $nuevafecha,
                'cuotaBonificacion' => 0,
                'matriculaId' => $matricula->matriculaId,
                ]);
            $nuevafecha = strtotime('+'.$i.' month', strtotime($matricula->comision->comisionFI)) ;
            $nuevafecha = date('Y-m-j', $nuevafecha);
        }
    }
}
