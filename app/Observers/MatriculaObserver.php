<?php

namespace App\Observers;

use App\Matricula;
use App\Cuota;
use App\Pago;
use Illuminate\Http\Request;

class MatriculaObserver
{
    public function __construct(){

    }
    /**
     * Generar SOLO la cuota de inscripcion al matricular..Cuando realizomo un create
     *
     * @param  \App\Matricula  $matricula
     * @return void
     */
    public function created(Matricula $matricula)
    {
        // genero lo cuota de inscripcion
        $cuota = Cuota::create([
            'cuotaConcepto'     => 'Inscripcion - '.$matricula->comision->curso->cursoNombre,
            'cuotaMonto'        => $matricula->comision->curso->cursoInscripcion,
            'cuotaFVencimiento' => $matricula->comision->comisionFI,
            'cuotaBonificacion' => 0,
            'matriculaId'       => $matricula->matriculaId,
        ]);

        // genero el pago de la inscripcion
        Pago::create([
            'pagoAbono'     => $matricula->comision->curso->cursoInscripcion,
            'pagoFAbono'    => date('Y-m-d'),
            'cuotaId'       => $cuota->cuotaId
        ]);

    }

    /**
     * Handle the matricula "updated" event.
     *
     * @param  \App\Matricula  $matricula
     * @return void
     */
    public function updated(Matricula $matricula)
    {
        //
    }

    /**
     * Handle the matricula "deleted" event.
     *
     * @param  \App\Matricula  $matricula
     * @return void
     */
    public function deleted(Matricula $matricula)
    {
        //
    }

    /**
     * Handle the matricula "restored" event.
     *
     * @param  \App\Matricula  $matricula
     * @return void
     */
    public function restored(Matricula $matricula)
    {
        //
    }

    /**
     * Handle the matricula "force deleted" event.
     *
     * @param  \App\Matricula  $matricula
     * @return void
     */
    public function forceDeleted(Matricula $matricula)
    {
        //
    }
}
