<?php

namespace App\Http\Controllers\Cuota;

use App\{Cuota, Pago, Matricula, Estudiante};
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
        // return response()->json($cuota->cuotaPagada() , 200);
        # valido cuotaId
        $datosValidoCuota = $request->validate([
            'cuotaId' => 'required|numeric'
        ],[
            'cuotaId.required' => 'La cuota es requerda, por favor verifique.',
            'cuotaId.numeric' => 'Se espera un valor numerico, por favor verifique.',
        ]);
         # verifico si hubo errores en la validaciones..
         if ($datosValidoCuota->fails()) {
            $errors = $datosValidoCuota->errors();
            // return $this->errorResponse('Error en la validacion del formulario, verifique',400);
            # retorno error 400..
            return $this->errorResponse($errors,400);
        }

        $cuota = Cuota::find($request->cuotaId);
        # verifico si la cuota seleccionada esta realmente pagada..
        if ($cuota->cuotaPagada()){
            return $this->errorResponse('Esta cuota esta abonada',422);
        }
        # verificar si es la ultima cuota que se debe pagar
        $cuotaAnterior = Cuota::find($cuota->cuotaId-1);
        if (!$cuotaAnterior->cuotaPagada()) {
            return $this->errorResponse('Hay cuotas anteriores que se deben abonar',422);
        }
        # es para validar los datos que vienen en el body
        $datosValido = $request->validate([
            'cuotaMonto' => 'required|numeric|min:100'
        ],[
            'cuotaMonto.required' => 'El Monto de la cuota es requerdio, por favor verifique.',
            'cuotaMonto.numeric' => 'Se espera un valor numerico, por favor verifique.',
        ]);
        # genero los pagos automatico..

        # fecha q necesito para el pago
        $now = date('Y-m-d');
        # id de la cuota a pagar..para luego ir recorriendo si son mas d una que se puede abonar..
        $cuotaPagada =  $cuota->cuotaId;
        
        # genero el registro de esta cuota para consultar el saldo
        $cuotaBuscada = Cuota::find($cuotaPagada);
        
        # resto del monto q voy abonar del saldo..
        if($datosValido['cuotaMonto']>$cuotaBuscada->cuotaFaltante()){
            # 1700 - 850 = 850
            $resto = $datosValido['cuotaMonto']-$cuotaBuscada->cuotaFaltante();
            # busco cuantas cuota tengo para pagar..
            $cociente= intdiv( $resto,$cuotaBuscada->cuotaMonto);
            
        }else{
            $resto = $datosValido['cuotaMonto'];
            $cociente=-1;
        }
        for ($i=0; $i <= $cociente  ; $i++) { 
            # creo el pago, con su respectivo montos(cuotaFaltante)
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
            if($resto>=$cuotaBuscada->cuotaMonto){
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
        return $this->successResponse('Cuota fue abonada correctamente',201);
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
