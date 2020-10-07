<?php

namespace App\Http\Controllers\Materia;

use App\Curso;
use App\Materia;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreMateriaRequest;
use App\Http\Requests\UpdateMateriaRequest;
use App\Traits\ApiResponser;
use App\Repositories\Materia\MateriaRepository;

class MateriaController extends ApiController
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $materiaRepository;

    public function __construct(MateriaRepository $materiaRepository)
    {
        $this->materiaRepository = $materiaRepository;
    }

    public function index()
    {
        return $this->showAll($this->materiaRepository->getAll(), 200);
    }

    /**
     * Devuelve todas las materias que no estan en un curso
     * @param Number $curso
     */
    public function indexMateriasDiff($curso)
    {
        $materia = $this->materiaRepository->getAll()->diff(Curso::findOrFail($curso)->materias);
        return $this->showAll($materia, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreMateriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMateriaRequest $request)
    {
        # agrego la materia nueva.
        $this->materiaRepository->create($request->all());
        return $this->successResponse('Materia fue creada correctamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        return $this->materiaRepository->getMateriaPorCurso($curso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateMateriaRequest  $request
     * @param  Number  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMateriaRequest $request, $materia)
    {
        $materiaBuscado = $this->materiaRepository->find($materia);
        $this->materiaRepository->update($materiaBuscado, $request->all());
        return $this->successResponse('Materia fue actualizado correctamente', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Number $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy( $materia )
    {
        $materiaBuscado = $this->materiaRepository->find($materia);
        if ($materiaBuscado->cursos->count() === 0){
            $this->materiaRepository->delete($materiaBuscado);
            return $this->successResponse('Materia fue eliminada correctamente', 200);
        }
        return $this->errorResponse('La Materia no puede ser eliminada', 409);

    }
}
