<?php

namespace App\Http\Controllers\Estudiante;

use App\Estudiante;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\IndexEstudianteFilterRequest;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Http\Requests\UpdateEstudianteFotoRequest;
use App\Traits\ApiResponser;
use App\Repositories\Estudiante\EstudianteRepository;
use Symfony\Component\HttpFoundation\Response;
class EstudianteController extends ApiController
{
    use ApiResponser;

    private $estudianteRepo;
    /**
     *  Constructor
     *
     * @param  App\Repositories\Estudiante\EstudianteRepository  $estudianteRepo
     */
    public function __construct(EstudianteRepository $estudianteRepo){
        $this->estudianteRepo = $estudianteRepo;
    }
    /**
     * Display a listing of the resource.
     * @param App\Http\Requests\IndexEstudianteFilterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexEstudianteFilterRequest $request)
    {
        $estudiante =  $this->estudianteRepo
                            ->getEstudianteDniApellido($request->getDni(), $request->getApellido());
        return $this->successResponse($estudiante, Response::HTTP_OK);
    }

    /**
     *  guardo los datos del formulario de inscripcion(del estudiante)..Estudiante $estudiante,
     *
     * @param  App\Http\Requests\StoreEstudianteRequest  $request
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
     * @param  App\Http\Requests\UpdateEstudianteRequest  $request
     * @param  Number  $estudianteId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstudianteRequest $request, $estudianteId)
    {
        $estudiante = $this->estudianteRepo->find($estudianteId);
        $estudianteNuevo = $this->estudianteRepo->update($estudiante, $request->all());
        return $this->showOne($estudianteNuevo);
    }
    /**
     * Actualizo los foto del estudiante
     *
     * @param  App\Http\Requests\UpdateEstudianteFotoRequest  $request
     * @param  Number $estudiante
     * @return \Illuminate\Http\Response
     */
    public function updateEstudianteFoto(UpdateEstudianteFotoRequest $request, $estudianteId)
    {
        $estudiante = $this->estudianteRepo->find($estudianteId);
        $path = $request->file->store('public/imagenes');
        $estudiante->estudianteFoto = $path;
        $estudiante->save();
        return $this->successResponse($estudiante, Response::HTTP_OK);
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
