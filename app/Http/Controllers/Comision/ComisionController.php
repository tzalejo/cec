<?php

namespace App\Http\Controllers\Comision;

use App\Comision;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\DestroyComisionRequest;
use App\Http\Requests\StoreComisionRequest;
use App\Http\Requests\UpdateComisionRequest;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Log;
# para usar validator
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComisionController extends ApiController
{
    use ApiResponser;
    /**
     * Devuelvo todas las comisiones     *
     *  - no activas con fecha de inicio desde hasta
     *  - sin filtro
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $fechaDesde = null, $fechaHasta = null)
    {
        $query = Comision::query()
            ->with('curso') # para optimizar la consulta
            ->with('matriculas') # para obtener los alumnos d esta comision
            ->withCount('matriculas') # envio cantidad de matricula por comision..
            ->orderBy('cursoId', 'ASC');

        if ($fechaDesde && $fechaHasta) {
            $query->ComisionesInactivas()
                ->ComisionesFechaDesde($fechaDesde)
                ->ComisionesFechaHasta($fechaHasta);
        }
        
        if (!$fechaDesde && !$fechaHasta) {
            $query->ComisionesActivas();
        }

        # devuelvo las comisiones
        return $this->showAll($query->get()); # usamos metodos de Traits para devolver
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
                    ->with('curso')
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
