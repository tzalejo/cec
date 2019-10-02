<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Materia;
class MateriaController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # obtengo las materias para mostrarla
        $materias = Materia::all();
        
        return view('materia.crear')
        ->with('materias',$materias);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($materia)
    {
        //
        dd($materia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
