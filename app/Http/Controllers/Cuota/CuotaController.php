<?php

namespace App\Http\Controllers\Cuota;

use App\Cuota;
use App\Matricula;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Traits\ApiResponser;

class CuotaController extends ApiController
{
    use ApiResponser;
    /**
     * Regreso todas las cuotas de una matricula.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Matricula $matricula)
    {
        # devuelvo estudiante->matricula->cuotas->pagos;
        return $this->showArray($matricula->load(['estudiante','cuotas','cuotas.pagos']));
        // return $this->showAll($matricula->cuotas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function show(Cuota $cuota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuota $cuota)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuota $cuota)
    {
        //
    }
}
