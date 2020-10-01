<?php

namespace App\Http\Controllers\Curso;

use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Repositories\Curso\CursoRepository;
use App\Traits\ApiResponser;

class CursoController extends ApiController
{
    use ApiResponser;
    /**
     * devulveo todo los cursos en orden por nombre ascendente.
     *
     * @return \Illuminate\Http\Response
     */
    private $cursoRepository;

    public function __construct(CursoRepository $cursoRepo){
        $this->cursoRepository = $cursoRepo;
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->cursoRepository->getAll();
        // return Curso::query()
        //             ->OrderByCampo('cursoNombre')
        //             ->get();
    }

    /**
     * Agrego el curso
     *
     * @param  App\Http\Requests\StoreCursoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCursoRequest $request)
    {
        $this->cursoRepository->create($request->all());
        return $this->successResponse('Curso fue creado correctamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param   Number $curso
     * @return  \App\Curso
     */
    public function show($curso)
    {
        return $this->cursoRepository->findCursoComisionActivas($curso);
    }

    /**
     * Actualizo curso
     *
     * @param  App\Http\Requests\UpdateCursoRequest $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        $this->cursoRepository->update($curso, $request->all());
        return $this->successResponse('Curso fue actualizado correctamente', 200);
    }

    /**
     * Update Curso Materia.
     *
     * @param  Number $materia
     * @param  Number $curso
     * @return \Illuminate\Http\Response
     */
    public function updateCursoMateria($curso, $materia)
    {
        # asigno en la tabla pivote curso y materia,
        $this->cursoRepository->find($curso)->materias()->attach($materia);
        return $this->successResponse('Materia fue asiganada al curso correctamente', 200);
    }

    /**
     * Remove un curso si no tiene materias relacionadas..
     *
     * @param  Number $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($curso)
    {
        # verifico q no tenga relacion con materia y comision
        if ($this->cursoRepository->cursoTieneMateriaComision($curso)){
            $this->cursoRepository->delete($curso);
            return $this->successResponse('Curso fue eliminada correctamente', 200);
        }
        return $this->successResponse('Curso seleccionado no puede ser eliminado.',409);
    }
}
