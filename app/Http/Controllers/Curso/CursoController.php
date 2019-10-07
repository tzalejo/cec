<?php

namespace App\Http\Controllers\Curso;

use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CursoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        # valido el curso..
        $datosValidado = $request->validate([
            'cursoNombre'       => 'required|min:2|max:100',
            'cursoNroCuota'     => 'required|numeric|max:48',
            'cursoCostoMes'     => 'required|numeric',
            'cursoInscripcion'  => 'required|numeric',
        ],
        [
            'cursoNombre.required'        => 'El Nombre del curso es requerido',
            'cursoNroCuota.required'      => 'La cantidad de cuotas es requerido',
            'cursoNroCuota.max'           => 'La cantidad de cuotas supera el valor maximo',
            'cursoCostoMes.required'      => 'El costo por mes es requerido',
            'cursoInscripcion.required'   => 'El Apellido del estudiante es requerdio',
            'cursoNroCuota.numeric'       => 'Debe ingresar un valor numerico',
            'cursoCostoMes.numeric'       => 'Debe ingresar un valor numerico',
            'cursoInscripcion.numeric'    => 'Debe ingresar un valor numerico',
        ]);
        # Agrego el curso
        $cursoNuevo = Curso::create([
            'cursoNombre'       => $datosValidado['cursoNombre'],
            'cursoNroCuota'     => $datosValidado['cursoNroCuota'],
            'cursoCostoMes'     => $datosValidado['cursoCostoMes'],
            'cursoInscripcion'  => $datosValidado['cursoInscripcion'],
        ]);
        
        # verifico si  seleccione materia, para agregar la relacion.
        if(!is_null($request['sele_materia'])){

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
