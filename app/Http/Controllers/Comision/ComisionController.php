<?php

namespace App\Http\Controllers\Comision;

use App\Comision;
use App\Matricula;
use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\DestroyComisionRequest;
use App\Http\Requests\StoreComisionRequest;
use App\Http\Requests\UpdateComisionRequest;
use App\Traits\ApiResponser;
# para usar validator
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComisionController extends ApiController
{
    use ApiResponser;
    /**
     * Devuelvo todas las comisiones activas(que no se cerraron por las fechas)
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fechaDesde = null, $fechaHasta = null, $curso = null )
    {
        if ($curso) {
            # cuando hago un get con parametro cursoId y obtengo todo las comision de este curso..
            $comisiones = Comision::ComisionesActivas()
                                    ->with('curso') # para optimizar la consulta
                                    ->with('matriculas') # para obtener los alumnos d esta comision
                                    ->withCount('matriculas') # envio cantidad de matricula por comision..
                                    ->where('cursoId', $curso)
                                    ->orderBy('cursoId', 'ASC')
                                    ->get(); # uso un scope

        } else {

            if ($fechaDesde && $fechaHasta) {
                # obtengo las comisiones NO activas y con fecha (Fecha Inicio) desde hasta
                $comisiones = Comision::ComisionesInactivas()
                                        ->with('curso') # para optimizar la consulta
                                        ->with('matriculas') # para obtener los alumnos d esta comision
                                        ->withCount('matriculas') # envio cantidad de matricula por comision..
                                        ->ComisionesFechaDesde($fechaDesde)
                                        ->ComisionesFechaHasta($fechaHasta)
                                        ->get();

            } else {
                # obtengo las comisiones activas, pero sin filtro alguno
                $comisiones = Comision::ComisionesActivas()
                                        ->with('curso') # para optimizar la consulta
                                        ->with('matriculas') # para obtener los alumnos d esta comision
                                        ->withCount('matriculas') # envio cantidad de matricula por comision..
                                        ->orderBy('cursoId', 'ASC')
                                        ->get(); # uso un scope
            }

        }
        # devuelvo las comisiones
        # return response()->json([$comisiones],200);
        return $this->showAll($comisiones); # usamos metodos de Traits para devolver

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
    public function store(StoreComisionRequest $request)
    {
        # creo la comision
        Comision::create([
            'comisionNombre'    => strtoupper($request->comisionNombre),
            'comisionHorario'   => strtoupper($request->comisionHorario),
            'comisionFI'        => $request->comisionFI,
            'comisionFF'        => $request->comisionFF,
            'cursoId'           => $request->cursoId,
        ]);

         # retorno ok
         return $this->successResponse('Comision fue creada correctamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show($comisionId)
    {
        $resultado = Comision::ComisionesActivas()
                    ->with('matriculas.estudiante') # para obtener los alumnos d esta comision
                    ->where('comisionId', $comisionId)
                    ->get(); # uso un scope
        return $this->successResponse($resultado, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComisionRequest $request, Comision $comision)
    {
        # actualizo
        $comision->update([
            'comisionNombre'    => strtoupper($request->comisionNombre),
            'comisionHorario'   => strtoupper($request->comisionHorario),
            'comisionFI'        => $request->comisionFI,
            'comisionFF'        => $request->comisionFF,
            'cursoId'           => $request->cursoId,
        ]);

         # retorno ok
         return $this->successResponse('Comision fue modificada correctamente', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyComisionRequest $comision)
    {
        # validamos si existe la comision y
        # si tiene matriculas
        $comisionEliminar = Comision::find($comision->comisionId);
        $comisionEliminar->delete();
        return $this->successResponse('Comision fue eliminada correctamente',200);
    }
}
