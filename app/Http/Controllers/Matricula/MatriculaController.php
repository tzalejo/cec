<?php

namespace App\Http\Controllers\Matricula;

use App\Matricula;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Http\Requests\StoreMatriculaRequest;
use App\Repositories\Matricula\MatriculaRepository;

class MatriculaController extends ApiController
{
    use ApiResponser;

    private $matriculaRepository;

    public function __construct(MatriculaRepository $matriculaRepo){
        $this->matriculaRepository = $matriculaRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {}

    /**
     * Matriculo al estudiante
     * Tambien se dispara matriculaObserver(created)
     * Recordar: regular(RE), no regular(NR) o egresado(EG)
     *
     *
     * @param  App\Http\Requests\StoreMatriculaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatriculaRequest $request)
    {
        $matricula = $this->matriculaRepository->create([
            'matriculaSituacion'=> Matricula::MATRICULASITUACION_RE ,
            'estudianteId'      =>$request->estudianteId,
            'comisionId'        =>$request->comisionId
        ]);
        return $this->showOne($matricula, 201);

    }

    /**
     *
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        # validar que exista la matricula..
        // $this->showOne($matricula, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateMatriculaRequest  $request
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatriculaRequest $request, $matriculaId)
    {
        $matricula = $this->matriculaRepository->find($matriculaId);
        # actualizo
        $this->matriculaRepository->update($matricula, $request->all());
        return $this->successResponse('Matricula fue modificada correctamente', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricula $matricula)
    {
        # dd($matricula->estudiante);
        # Se elimina logicamente ( no regular: NR )..
        # Dejaremos los datos del estudiante..
        // $matricula->matriculaSituacion = 'NR';
        // $matricula->update();
    }
}
