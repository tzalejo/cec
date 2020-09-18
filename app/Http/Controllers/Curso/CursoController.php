<?php

namespace App\Http\Controllers\Curso;

use App\Comision;
use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreCursoRequest;
use App\Traits\ApiResponser;

class CursoController extends ApiController
{
    use ApiResponser;
    /**
     * devulveo todo los cursos en orden por nombre ascendente.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Curso::query()
                    ->orderBy('cursoNombre','ASC')
                    ->get();
    }

    /**
     * Agrego el curso
     * @param  Illuminate\Foundation\Http\FormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCursoRequest $request)
    {
        $cursoNuevo = Curso::create([
            'cursoNombre'       => $request['cursoNombre'],
            'cursoNroCuota'     => $request['cursoNroCuota'],
            'cursoCostoMes'     => $request['cursoCostoMes'],
            'cursoInscripcion'  => $request['cursoInscripcion'],
        ]);

        # verifico si  seleccione materia, para agregar la relacion.
        if (!is_null($request['sele_materia'])) {
            $seleccionMaterias = $request['sele_materia'];
            # agrego las materias..
            $cursoNuevo->materias()->attach($seleccionMaterias);
        }
        return $this->successResponse('Curso fue creado correctamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param   number $curso
     * @return  \App\Curso
     */
    public function show($curso)
    {
        return Curso::query()
                ->where('cursoId', $curso)
                ->with(['comisiones' => function ($query) {
                    $query->ComisionesActivas();
                }])
                ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        # si es null materiaId es porque quiero actualizar curso
        # ahora si distinto de null es porque vamos actualizar la relacion curso materia
        if ($request['materiaId'] ) {
            # lo que hago con attach es asignarle en la tabla pivote curso y materia,
            # osea creando la relacion materia-curso
            $curso->materias()->attach($request['materiaId']);
            return $this->successResponse('Materia fue asiganada al curso correctamente', 200);
        }
        # actualizo curso
        $curso->update([
            'cursoNombre'       => $request['cursoNombre'],
            'cursoNroCuota'     => $request['cursoNroCuota'],
            'cursoCostoMes'     => $request['cursoCostoMes'],
            'cursoInscripcion'  => $request['cursoInscripcion'],
        ]);
        return $this->successResponse('Curso fue actualizado correctamente', 200);
    }

    /**
     * Remove un curso si no tiene materias relacionadas..
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        # verifico q no tenga relacion con materia y comision
        if ($curso->materias->count() === 0 && $curso->comisiones->count() === 0){
            $curso->delete();
            return $this->successResponse('Curso fue eliminada correctamente', 200);
        }
        return $this->successResponse('Curso seleccionado no puede ser eliminado.',409);
    }
}
