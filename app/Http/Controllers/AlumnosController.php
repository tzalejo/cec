<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comision;
use App\Estudiante;
use App\Matricula;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;


class AlumnosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }
    // muestro el formulario de inscripcion
    public function inscripcion(){
        $now = date('Y-m-d');
        $comisionesAbiertas = Comision::where('comisionFF', '>', $now)->get();
        return view('alumnos.inscripcion')->with('comisionesAbiertas',$comisionesAbiertas);
    }
    // guardo los datos del formulario de inscripcion..
    public function store(Request $request){

        // ucfirst('texto') ->> 'Texto'

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
            'estudianteId'      =>$estudianteNuevo->estudianteId ,
            'comisionId'        =>$request->get('comisionId') ,
        ]);

        return view('home')->with('comisiones', Comision::all());
    }
    
    public function show($paginado){
        // $page = $request->get('page', 1);
        $estudiantes = Estudiante::paginate($paginado);
        
        return view('alumnos.mostrar')
            ->with('estudiantes', $estudiantes);
        
    }

    public function edit(Matricula $matricula){
        $now = date('Y-m-d');
        $estudiante = $matricula->estudiante;
        $comisionesAbiertas = Comision::where('comisionFF', '>', $now)->get();
        $miComision = $matricula->comision; // envio la comision de la matricula
        return view('alumnos.editar')
        ->with('estudiante',$estudiante)
        // envio la matricula para luego modificar la  comsion de esa matricula
        ->with('matricula',$matricula->matriculaId) 
        ->with('comisionesAbiertas',$comisionesAbiertas)
        ->with('miComision',$miComision);
    }

    public function update(Estudiante $estudiante, Request $request){

        // validamos los campos
        $datosValidado = $request->validate([
            'estudianteNombre'      => 'required|min:3|max:50',
            'estudianteApellido'    => 'required|min:3|max:50',
            'estudianteDNI'         => ['required','numeric',Rule::unique('estudiantes','estudianteDNI' )->ignore($estudiante->estudianteDNI,'estudianteDNI')], 
            'estudianteDomicilio'   => 'required|max:100',
            // estoy indicando que el valor sea unico en la tabla estudiantes del campo estudianteEmail PERO ESCLUYENDO EL estudianteId!!, el cual estoy modificando.. 
            'estudianteEmail'       => ['email','max:100',Rule::unique('estudiantes','estudianteEmail' )->ignore($estudiante->estudianteId, 'estudianteId') ], 
            'estudianteTelefono'    => 'max:50',
            'estudianteLocalidad'   => 'required|max:100',
            'estudianteNacimiento'  => 'required|date',
            'estudianteFoto'        => ''
        ]); 

        // dd($request->all());
        // actualizar Estudiante y matricula(comision)
        $matricula = Matricula::find($request->get('matricula'));
        $matricula->comisionId = $request->get('comisionId');
        $matricula->save();

        // aca especifico el mensaje d cierto error.
        if (is_null($request->get('estudianteFoto'))) {
            $estudiante->update([
                'estudianteNombre'      => $datosValidado['estudianteNombre'],
                'estudianteApellido'    => $datosValidado['estudianteApellido'],
                'estudianteDNI'         => $datosValidado['estudianteDNI'],
                'estudianteDomicilio'   => $datosValidado['estudianteDomicilio'],
                'estudianteEmail'       => $datosValidado['estudianteEmail'],
                'estudianteTelefono'    => $datosValidado['estudianteTelefono'],
                'estudianteLocalidad'   => $datosValidado['estudianteLocalidad'],
                'estudianteNacimiento'  => $datosValidado['estudianteNacimiento'],
                // verifico si viene la foto null no modifico caso contrario agrego el nueva imagen..
                // 'estudianteFoto'        => $datosValidado['estudianteFoto'], xq no se modifico la imagien
            ]);
        } else {
            # code...
            $estudiante->update($datosValidado);
        }
        return redirect()->route('home');
    }
    
    public function destroy(Matricula $matricula){
        // dd($matricula->estudiante);
        // Se elimina logicamente ( no regular: NR )..
        // Dejaremos los datos del estudiante..
        $matricula->matriculaSituacion = 'NR';
        $matricula->update();
        
        // dd(Auth::user()->userNombre);
        return redirect()->route('home');

    }
}
