<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comision;
use App\Estudiante;
use App\Matricula;
use App\Cuota;
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
    public function store(Estudiante $estudiante, Request $request){

        // ucfirst('texto') ->> 'Texto'
        // dd($request->all('pagoInscripcion')); viene null cuando no esta tildada la casilla, caso contrario en on
        // validamos los campos
        $datosValidado = $request->validate([
            'estudianteNombre'      => 'required|min:3|max:50',
            'estudianteApellido'    => 'required|min:3|max:50',
            'estudianteDNI'         => ['required','numeric',Rule::unique('estudiantes','estudianteDNI')],
            'estudianteDomicilio'   => 'required|max:100',
            'estudianteEmail'       => '',
            // 'estudianteEmail'       => ['email','max:100',Rule::unique('estudiantes','estudianteEmail')],
            'estudianteTelefono'    => 'max:50',
            'estudianteLocalidad'   => 'required|max:100',
            'estudianteNacimiento'  => 'required|date',
            'estudianteFoto'        => ''
        ],
        [
            'estudianteDNI.required' => 'El DNI del estudiante es requerdio',
            'estudianteDNI.unique'   => 'El DNI del estudiante ya existe',
            // 'estudianteEmail.email'  => 'El Email es incorrecto, verifique el formato example@mail.com',
            // 'estudianteEmail.unique' => 'El Email del estudiante ya esta registrado, verifique',
            
        ]); // aca especifico el mensaje d cierto error.
        
        // creo el estudiante, con su respectiva matricula
        $estudianteNuevo = Estudiante::create([
            'estudianteNombre'      => ucwords(strtolower($datosValidado['estudianteNombre'])),
            'estudianteApellido'    => ucwords(strtolower($datosValidado['estudianteApellido'])),
            'estudianteDNI'         => $datosValidado['estudianteDNI'],
            'estudianteDomicilio'   => ucwords(strtolower($datosValidado['estudianteDomicilio'])),
            'estudianteEmail'       => $datosValidado['estudianteEmail'],
            'estudianteTelefono'    => $datosValidado['estudianteTelefono'],
            'estudianteLocalidad'   => strtolower($datosValidado['estudianteLocalidad']),
            'estudianteNacimiento'  => $datosValidado['estudianteNacimiento'],
            'estudianteFoto'        => $datosValidado['estudianteFoto'],
        ]);
        
        // Recordar: regular(RE), no regular(NR) o egresado(EG)
        $matricula =  Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'      =>$estudianteNuevo->estudianteId ,
            'comisionId'        =>$request->get('comisionId') ,
        ]);
        // dd($matriculaId->matriculaId);
        if (is_null($request->get('pagoInscripcion')) && is_null($request->get('pagoCuota'))) {
            # es porque ninguna de las dos casilla esta tildada..
            return view('home')->with('comisiones', Comision::all());
        } else {
            # Si alguna casilla(inscripcion o cuota) esta tildada.
            # generar las cuotas de la matricula..
            $nuevafecha = $matricula->comision->comisionFI;
            Cuota::create([
                'cuotaConcepto' => 'Inscripcion - '.$matricula->comision->curso->cursoNombre,
                'cuotaMonto' => $matricula->comision->curso->cursoInscripcion,
                'cuotaFVencimiento' => $nuevafecha,
                'cuotaBonificacion' => 0,
                'matriculaId' => $matricula->matriculaId,
                ]);
            for ($i=1; $i <= $matricula->comision->curso->cursoNroCuota ; $i++) { 
                # code...
                Cuota::create([
                    'cuotaConcepto' => 'Cuota '.$i.' - '.$matricula->comision->curso->cursoNombre,
                    'cuotaMonto' => $matricula->comision->curso->cursoCostoMes,
                    'cuotaFVencimiento' => $nuevafecha,
                    'cuotaBonificacion' => 0,
                    'matriculaId' => $matricula->matriculaId,
                    ]);
                $nuevafecha = strtotime ( '+'.$i.' month' , strtotime ( $matricula->comision->comisionFI ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            }
            return redirect()
            ->route('alumnos.pago', $matricula);
        }
        
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
        // ver el tema de las cuotas si hay cambio..                    *Falta!*


        // validamos los campos
        $datosValidado = $request->validate([
            'estudianteNombre'      => 'required|min:3|max:50',
            'estudianteApellido'    => 'required|min:3|max:50',
            'estudianteDNI'         => ['required','numeric',Rule::unique('estudiantes','estudianteDNI' )->ignore($estudiante->estudianteDNI,'estudianteDNI')], 
            'estudianteDomicilio'   => 'required|max:100',
            // estoy indicando que el valor sea unico en la tabla estudiantes del campo estudianteEmail PERO ESCLUYENDO EL estudianteId!!, el cual estoy modificando.. 
            // 'estudianteEmail'       => ['email','max:100',Rule::unique('estudiantes','estudianteEmail' )->ignore($estudiante->estudianteId, 'estudianteId') ], 
            'estudianteEmail'       => '', 
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
                'estudianteNombre'      => ucwords(strtolower($datosValidado['estudianteNombre'])),
                'estudianteApellido'    => ucwords(strtolower($datosValidado['estudianteApellido'])),
                'estudianteDNI'         => $datosValidado['estudianteDNI'],
                'estudianteDomicilio'   => ucwords(strtolower($datosValidado['estudianteDomicilio'])),
                'estudianteEmail'       => $datosValidado['estudianteEmail'],
                'estudianteTelefono'    => $datosValidado['estudianteTelefono'],
                'estudianteLocalidad'   => strtolower($datosValidado['estudianteLocalidad']),
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

    public function pago(Matricula $matricula){

        return view('alumnos.pago')->with('matricula',$matricula);;
    }
}
