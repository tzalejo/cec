<?php

namespace App\Http\Controllers\Curso;

use App\Comision;
use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreCursoRequest;

class CursoController extends ApiController
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCursoRequest $request)
    {
        # Agrego el curso
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
            // Ya no lo necesito al cartel: toast('Se guardó correctamente la Curso.','success');
            
            // return redirect()
            // ->route('home')->with('comisiones', Comision::all());
        }
        return $this->showAll(Comision::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        //
    }
}
