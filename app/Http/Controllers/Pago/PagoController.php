<?php

namespace App\Http\Controllers\Pago;

use App\Pago;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePagoRequest;
use App\Traits\ApiResponser;
use App\Http\Controllers\ApiController;

class PagoController extends ApiController
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * Se dispara PagoObserver cuando la cuota esta pagada
     *
     * @param  App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request)
    {
        Pago::create([
            'pagoAbono'     => $request->pagoAbono,
            'pagoFAbono'    => date('Y-m-d'),
            'cuotaId'       => $request->cuotaId
            ]);
        return $this->successResponse('Cuota fue abonada correctamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
