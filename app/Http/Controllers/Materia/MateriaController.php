<?php

namespace App\Http\Controllers\Materia;

use App\Curso;
use App\Materia;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreMateriaRequest;
use App\Http\Requests\UpdateMateriaRequest;
use App\Traits\ApiResponser;
class MateriaController extends ApiController
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($curso = null)
    {
        $todoCursos = Materia::All();
        # si viene curso, es porque necesito retornar los materias que no esten el curso
        if ($curso) {
            # diff retorna la diferencia
            $todoCursos =  $todoCursos->diff( Curso::findOrFail($curso)->materias );
        }
        return $this->showAll($todoCursos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMateriaRequest $request)
    {
        # agrego la materia nueva.
        $materiaNueva = Materia::create([
            'materiaNombre'       => strtoupper($request->materiaNombre),
            'materiaSeminario'    => $request->materiaSeminario,
        ]);
        return $this->showOne($materiaNueva,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        # retron a todas las materias del curso->cursoId
        return $this->showAll($curso->materias, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMateriaRequest $request, Curso $curso)
    {
        // $curso->materia()->attach($materia->materiaId);
        // $curso->materia()->sync($materia->materiaId); 
        # con sync nos aseguramos q el curso no tenga repetida las materias
        return $curso->materias()->async($request->materiaId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy( Materia $materia, $curso=null )
    {   
        if ($curso) {
            # elimino materia
            $materia->delete();
            return $this->successResponse('Materia fue eliminada correctamente', 200);
        }
        # elimino la relacion curso - materia 
        # lo hacemos con detach, con esto hace es despegar(traduccion de detach) la relacion con curso
        $curso = Curso::findOrFail($curso);
        $curso->materia()->detach($materia->materiaId);
    }
}
