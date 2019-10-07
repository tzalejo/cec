<?php

namespace App\Http\Controllers\Cuota;

use App\Cuota;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CuotaController extends ApiController
{
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
        # dd($request->validate('cuotaMonto'));
        $datosValido = $request->validate([
            'cuotaMonto' => 'required|numeric|min:100'
        ],[
            'cuotaMonto.required' => 'El Monto de la cuota es requerdio, por favor verifique.',
            'cuotaMonto.numeric' => 'Se espera un valor numerico, por favor verifique.',
        ]);
        # genero los pagos automatico..

        # fecha q necesito para el pago
        $now = date('Y-m-d');
        # id de la cuota a pagar..
        $cuotaPagada =  $cuota->cuotaId;
        # dd($cuota->cuotaId);
        # genero el registro de esta cuota para consultar el saldo
        $cuotaBuscada = Cuota::find($cuotaPagada);
        
        # resto del monto q voy abonar del saldo..
        if($datosValido['cuotaMonto']>$cuotaBuscada->cuotaFaltante()){
            $resto = $datosValido['cuotaMonto']-$cuotaBuscada->cuotaFaltante();
            # busco cuantas cuota tengo para pagar..
            $cociente= intdiv( $resto,$cuotaBuscada->cuotaMonto);
            
        }else{
            $resto = $datosValido['cuotaMonto'];
            $cociente=-1;
        }
        for ($i=0; $i <= $cociente  ; $i++) { 
            Pago::create([
                'pagoAbono'     => $cuotaBuscada->cuotaFaltante(),
                'pagoFAbono'    => $now,
                'cuotaId'       => $cuotaPagada
                ]);
            # como los pagos son secuenciales, sumo uno para ir a la siguiente cuota
            $cuotaPagada++;
            # busco la cuota
            $cuotaBuscada = Cuota::find($cuotaPagada);
            # resto el monto total
            if($resto>$cuotaBuscada->cuotaMonto){
                $resto = $resto-$cuotaBuscada->cuotaMonto;
            }
        }
        # Ahora si el monto es inferior a lo faltante de la cuota..
        if($resto>0){
            Pago::create([
                'pagoAbono' => $resto,
                'pagoFAbono' => $now,
                'cuotaId' => $cuotaPagada
            ]);
        }
        // return redirect()->route('alumnos.cuotas',$cuota->matricula);
        return $this->successResponse('Cuota almacenada correctamente',200);
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
