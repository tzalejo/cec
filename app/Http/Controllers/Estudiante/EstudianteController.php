<?php

namespace App\Http\Controllers\Estudiante;

use App\Estudiante;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Traits\ApiResponser;
use App\Repositories\Estudiante\EstudianteRepository;

class EstudianteController extends ApiController
{
    use ApiResponser;

    private $estudianteRepo;

    public function __construct(EstudianteRepository $estudianteRepo){
        $this->estudianteRepo = $estudianteRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estudiante =  $this->estudianteRepo
                            ->getEstudianteDniApellido($request->get('dni'), $request->get('apellido'));

        return $this->successResponse($estudiante, 200);
    }

    /**
     *  guardo los datos del formulario de inscripcion(del estudiante)..Estudiante $estudiante,
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstudianteRequest $request)
    {
        $estudianteNuevo = $this->estudianteRepo->create($request->all());
        return $this->showOne($estudianteNuevo);
    }
    /**
     * Este api lo usabaa para filtrado por DNI y/o por apellido.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show()
    {}

    /**
     * Actualizo los datos del estudiante y tambien el comision de la matricula enviada..
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstudianteRequest $request, $estudianteId)
    {
        $estudiante = $this->estudianteRepo->find($estudianteId);
        $estudianteNuevo = $this->estudianteRepo->update($estudiante, $request->all());
        return $this->showOne($estudianteNuevo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
