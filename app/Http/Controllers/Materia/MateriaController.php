<?php

namespace App\Http\Controllers\Materia;

use App\Materia;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class MateriaController extends ApiController
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
        $datosValidado = $request->validate([
            'materiaNombre'     => 'required|min:2|max:100', 
        ],[
            'materiaNombre.required' => 'El Nombre del curso es requerido',
        ]);
        # veo si es seminario o materia
        $seminario = ($request['materiaSeminario'] == 'seminario') ? true : false ;
        # agrego la materia nueva.
        $materiaNueva = Materia::create([
            'materiaNombre'       => $datosValidado['materiaNombre'],
            'materiaSeminario'    => $seminario,
        ]);
        # mesaje de ok..
        toast('Se guardó correctamente la Materia.','success');
        # envio al mismo formulario de crear materia, solo actualizo el listado

        return redirect()
            // ->withToastSuccess('No tiene suficientes Privilegios para acceder a esta seccion.')
            ->route('materia.crear')->with('materias', Materia::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        //
        # toast('No puede ingresar..','warning');
        $materias = Materia::all();
        $seleccion_materias = array();
        return view('curso.crear')
        ->with('materias',$materias)
        ->with('seleccion_materias',$seleccion_materias); ## variable de .blade ##
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        # ver si tengo que verificar si la materia no tiene relaciona con otras..
        #######
        #######
        
        # elimino la materia seleccionada..
        $materia->delete();
        # mesaje de ok..
        toast('Se elimino correctamente la Materia.','success');
        return redirect()
            // ->withToastSuccess('No tiene suficientes Privilegios para acceder a esta seccion.')
            ->route('materia.crear')->with('materias', Materia::all());
    }
}
