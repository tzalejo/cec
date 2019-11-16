<?php

namespace App\Http\Controllers\Comision;

use App\{Comision,Matricula,Curso};
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Traits\ApiResponser;

class ComisionController extends ApiController
{
    use ApiResponser;
    /**
     * Devuelvo todas las comisiones activas(que no se cerraron por las fechas)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # obtengo las comisiones activas, 
        $comisionesActivas = Comision::ComisionesActivas()
                                ->with('curso') # para optimizar la consulta
                                ->get() # uso un scope
                                ->load(['matriculas']); # envio tmb las matriculas que tiene cada curso
        # devuelvo las comisiones
        # return response()->json([$comisionesActivas],200);
        return $this->showAll($comisionesActivas); # usamos metodos de Traits para devolver  
        
        #########################
        # esto estaba en el home:
       
        #$comisiones = Comision::with('matriculas') 
        #                    ->with('curso')
        #                    ->get();
        # envio a mi api 
        #return response()->json($comisiones, 200);  # return view('home')->with('comisiones', $comisiones);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show(Comision $comision)
    {
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comision $comision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comision $comision)
    {
        //
    }
}
