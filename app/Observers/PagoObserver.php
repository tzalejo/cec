<?php

namespace App\Observers;

use App\Pago;
use App\Cuota;
use App\Matricula;
use App\Services\PagoService;

class PagoObserver
{
    /**
     * Handle the pago "created" event.
     * Veo si la cuota fue abonada en su totalidad y
     * no superar la cantidad de cuotas por curso
     * entonces generar la siguiente.
     *
     * @param  \App\Pago  $pago
     * @return void
     */
    public function created(Pago $pago)
    {
        $pagoService = new PagoService($pago);
        if ($pagoService->cuotaEstaPagada() && $pagoService->esElMaximoDeCuotas())
        {
            Cuota::create([
                'cuotaConcepto'     => $pagoService->nombreDeLaCuota(),
                'cuotaMonto'        => $pagoService->costoPorMes(),
                'cuotaFVencimiento' => $pagoService->nuevaFechaDeVencimiento(),
                'cuotaBonificacion' => 0,
                'matriculaId'       => $pagoService->matriculaDeLaCuota(),
            ]);
        }
    }

    /**
     * Handle the pago "updated" event.
     *
     * @param  \App\Pago  $pago
     * @return void
     */
    public function updated(Pago $pago)
    {
        //
    }

    /**
     * Handle the pago "deleted" event.
     *
     * @param  \App\Pago  $pago
     * @return void
     */
    public function deleted(Pago $pago)
    {
        //
    }

    /**
     * Handle the pago "restored" event.
     *
     * @param  \App\Pago  $pago
     * @return void
     */
    public function restored(Pago $pago)
    {
        //
    }

    /**
     * Handle the pago "force deleted" event.
     *
     * @param  \App\Pago  $pago
     * @return void
     */
    public function forceDeleted(Pago $pago)
    {
        //
    }
}
