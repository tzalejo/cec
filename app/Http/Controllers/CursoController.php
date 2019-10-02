<?php
namespace App\Http\Controllers;

use App\{Materia,Curso,Comision,User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
class CursoController extends Controller
{
    /**
     * Aplico el middleware-director para todo el controller
     *
     * @return void
     */
    // public function __construct(){
    //     $this->middleware('director');
    // }


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
        # toast('No puede ingresar..','warning');
        $materias = Materia::all();
        $seleccion_materias = array();
        return view('curso.crear')
        ->with('materias',$materias)
        ->with('seleccion_materias',$seleccion_materias);
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
        // dd($request);
        # Agrego el curso
        $cursoNuevo = Curso::create([
            'cursoNombre'       => $datosValidado['cursoNombre'],
            'cursoNroCuota'     => $datosValidado['cursoNroCuota'],
            'cursoCostoMes'     => $datosValidado['cursoCostoMes'],
            'cursoInscripcion'  => $datosValidado['cursoInscripcion'],
        ]);
     
        # verifico si  seleccione materia, para agregar la relacion.
        if(!is_null($request['sele_materia'])){
            // dd($request['sele_materia']);
            $seleccionMaterias = $request['sele_materia'];
            # agrego las materias..
            $cursoNuevo->materias()->attach($seleccionMaterias); 
            toast('Se guardó correctamente la Curso.','success');
            return redirect()
            ->route('home')->with('comisiones', Comision::all());
        }

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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
