<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comision;
use App\Estudiante;
use App\Matricula;
use Illuminate\Http\UploadedFile;
 
class AlumnosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inscripcion(){
        $now = date('Y-m-d');
        $comisionesAbiertas = Comision::where('comisionFF', '>', $now)->get();
        return view('alumnos.inscripcion')->with('comisionesAbiertas',$comisionesAbiertas);
    }

    public function store(Request $request){

        // validamos los campos
        $datosValidado = $request->validate([
            'estudianteNombre'      => 'required|min:3|max:50',
            'estudianteApellido'    => 'required|min:3|max:50',
            'estudianteDNI'         => 'required|min:6|max:9|numeric|unique:estudiates,estudianteDNI', 
            'estudianteDomicilio'   => 'required|max:100',
            'estudianteEmail'       => 'email|max:100|unique:estudiantes,estudianteEmail', // estoy indicando que el valor sea unico en la tabla estudiantes del campo estudianteEmail
            'estudianteTelefono'    => 'max:50',
            'estudianteLocalidad'   => 'required|max:100',
            'estudianteNacimiento'  => 'required|date',
            'estudianteFoto'        => ''
        ],
        ['estudianteDNI.required' => 'El DNI del estudiante es requerdio']); // aca especifico el mensaje d cierto error.
        
        // creo el estudiante, con su respectiva matricula
        $estudianteNuevo = Estudiante::create([
            'estudianteNombre'      => $datosValidado['estudianteNombre'],
            'estudianteApellido'    => $datosValidado['estudianteApellido'],
            'estudianteDNI'         => $datosValidado['estudianteDNI'],
            'estudianteDomicilio'   => $datosValidado['estudianteDomicilio'],
            'estudianteEmail'       => $datosValidado['estudianteEmail'],
            'estudianteTelefono'    => $datosValidado['estudianteTelefono'],
            'estudianteLocalidad'   => $datosValidado['estudianteLocalidad'],
            'estudianteNacimiento'  => $datosValidado['estudianteNacimiento'],
            'estudianteFoto'        => $datosValidado['estudianteFoto'],
        ]);
        
        // Recordar: regular(RE), no regular(NR) o egresado(EG)
        Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'=>$estudianteNuevo->estudianteId ,
            'comisionId'=>$request->get('comisionId') ,
        ]);

        return view('home')->with('comisiones', Comision::all());
    }
    
}
