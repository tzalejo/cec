<?php

namespace App\Http\Controllers\Estudiante;

use App\Comision;
use App\Estudiante;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Traits\ApiResponser;

class EstudianteController extends ApiController
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     *  guardo los datos del formulario de inscripcion(del estudiante)..Estudiante $estudiante,
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # ucfirst('texto') ->> 'Texto'
        # dd($request->all('pagoInscripcion')); viene null cuando no esta tildada la casilla, caso contrario en on
        # validamos los campos
        $datosValidado = $request->validate([
            'estudianteNombre'      => 'required|min:3|max:50',
            'estudianteApellido'    => 'required|min:3|max:50',
            'estudianteDNI'         => ['required','numeric',Rule::unique('estudiantes','estudianteDNI')],
            'estudianteDomicilio'   => 'required|max:100',
            'estudianteEmail'       => '',
            # 'estudianteEmail'       => ['email','max:100',Rule::unique('estudiantes','estudianteEmail')],
            'estudianteTelefono'    => 'max:50',
            'estudianteLocalidad'   => 'required|max:100',
            'estudianteNacimiento'  => 'required|date',
            'estudianteFoto'        => ''
        ],
        [
            'estudianteDNI.required'        => 'El DNI del estudiante es requerido',
            'estudianteDNI.unique'          => 'El DNI del estudiante ya existe',
            'estudianteNombre.required'     => 'El Nombre del estudiante es requerido',
            'estudianteApellido.required'   => 'El Apellido del estudiante es requerido',
            'estudianteDomicilio.required'  => 'El Domicilio del estudiante es requerido',
            'estudianteLocalidad.required'  => 'El Localidad del estudiante es requerido',
            'estudianteNacimiento.required' => 'El Nacimiento del estudiante es requerido',
            
            # 'estudianteEmail.email'  => 'El Email es incorrecto, verifique el formato example@mail.com',
            # 'estudianteEmail.unique' => 'El Email del estudiante ya esta registrado, verifique',
            
        ]); # aca especifico el mensaje d cierto error.
        
        # creo el estudiante, con su respectiva matricula
        $estudianteNuevo = Estudiante::create([
            'estudianteNombre'      => ucwords(strtolower($datosValidado['estudianteNombre'])),
            'estudianteApellido'    => ucwords(strtolower($datosValidado['estudianteApellido'])),
            'estudianteDNI'         => $datosValidado['estudianteDNI'],
            'estudianteDomicilio'   => ucwords(strtolower($datosValidado['estudianteDomicilio'])),
            'estudianteEmail'       => strtolower($datosValidado['estudianteEmail']),
            'estudianteTelefono'    => $datosValidado['estudianteTelefono'],
            'estudianteLocalidad'   => strtolower($datosValidado['estudianteLocalidad']),
            'estudianteNacimiento'  => $datosValidado['estudianteNacimiento'],
            'estudianteFoto'        => $datosValidado['estudianteFoto'],
        ]);
        
        # Recordar: regular(RE), no regular(NR) o egresado(EG)
        $matricula =  Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'      =>$estudianteNuevo->estudianteId ,
            'comisionId'        =>$request->get('comisionId') ,
        ]);
        # pregunto por las casillas 
        if (is_null($request->get('pagoInscripcion')) && is_null($request->get('pagoCuota'))) {
            # es porque ninguna de las dos casilla esta tildada..
            # return view('home')->with('comisiones', Comision::all());
            return $this->showAll(Comision::all());
        } else {
            # Si alguna casilla(inscripcion o cuota) esta tildada.
            # generar las cuotas de la matricula..
            $nuevafecha = $matricula->comision->comisionFI;
            Cuota::create([
                'cuotaConcepto'     => 'Inscripcion - '.$matricula->comision->curso->cursoNombre,
                'cuotaMonto'        => $matricula->comision->curso->cursoInscripcion,
                'cuotaFVencimiento' => $nuevafecha,
                'cuotaBonificacion' => 0,
                'matriculaId'       => $matricula->matriculaId,
                ]);
            for ($i=1; $i <= $matricula->comision->curso->cursoNroCuota ; $i++) { 
                # code...
                Cuota::create([
                    'cuotaConcepto'     => 'Cuota '.$i.' - '.$matricula->comision->curso->cursoNombre,
                    'cuotaMonto'        => $matricula->comision->curso->cursoCostoMes,
                    'cuotaFVencimiento' => $nuevafecha,
                    'cuotaBonificacion' => 0,
                    'matriculaId'       => $matricula->matriculaId,
                    ]);
                $nuevafecha = strtotime ( '+'.$i.' month' , strtotime ( $matricula->comision->comisionFI ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            }
            # return redirect()->route('alumnos.cuotas', $matricula);
            return $this->showOne($matricula);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        # primero dejo en minuscula to el apellido y en mayusucula la primera letra
        $apellido = ucwords(strtolower($request->get('estudianteApellido')));            # ver
        $DNI = $request->get('estudianteDNI');
        $estudiantes = Estudiante::query()
        ->with('matriculas.comision.curso')  # me genera menos query..?¿?¿?¿
        ->estudianteApellido($apellido)
        ->estudianteDNI($DNI)
        ->orderBy('estudianteId','ASC')
        ->paginate(10);
        
        # return view('alumnos.mostrar')->with('estudiantes', $estudiantes);
        # devuelve el estudiante con sus matriculas
        // return response()->json($estudiantes, 200);
        return $this->successResponse($estudiantes,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        # ver el tema de las cuotas si hay cambio..                    *Falta!*


        # validamos los campos
        $datosValidado = $request->validate([
            'estudianteNombre'      => 'required|min:3|max:50',
            'estudianteApellido'    => 'required|min:3|max:50',
            'estudianteDNI'         => ['required','numeric',Rule::unique('estudiantes','estudianteDNI' )->ignore($estudiante->estudianteDNI,'estudianteDNI')], 
            'estudianteDomicilio'   => 'required|max:100',
            # estoy indicando que el valor sea unico en la tabla estudiantes del campo estudianteEmail PERO ESCLUYENDO EL estudianteId!!, el cual estoy modificando.. 
            # 'estudianteEmail'       => ['email','max:100',Rule::unique('estudiantes','estudianteEmail' )->ignore($estudiante->estudianteId, 'estudianteId') ], 
            'estudianteEmail'       => '', 
            'estudianteTelefono'    => 'max:50',
            'estudianteLocalidad'   => 'required|max:100',
            'estudianteNacimiento'  => 'required|date',
            'estudianteFoto'        => ''
        ]); 

        # dd($request->all());
        # actualizar Estudiante y matricula(comision)
        $matricula = Matricula::find($request->get('matricula'));
        $matricula->comisionId = $request->get('comisionId');
        $matricula->save();

        # aca especifico el mensaje d cierto error.
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
                # verifico si viene la foto null no modifico caso contrario agrego el nueva imagen..
                # 'estudianteFoto'        => $datosValidado['estudianteFoto'], xq no se modifico la imagien
            ]);
        } else {
            # code...
            $estudiante->update($datosValidado);
        }
        // return redirect()->route('home');
        return $this->successResponse('Estudiante modificado correctamente');
        
        /*
        # viene de altaReinscripcionEstudiante
        
        # Recordar: regular(RE), no regular(NR) o egresado(EG)
        $matricula =  Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'      =>$estudiante->estudianteId ,
            'comisionId'        =>$request->get('comisionId') ,
        ]);

        # generar las cuotas de la matricula..
        $nuevafecha = $matricula->comision->comisionFI;
        Cuota::create([
            'cuotaConcepto'     => 'Inscripcion - '.$matricula->comision->curso->cursoNombre,
            'cuotaMonto'        => $matricula->comision->curso->cursoInscripcion,
            'cuotaFVencimiento' => $nuevafecha,
            'cuotaBonificacion' => 0,
            'matriculaId'       => $matricula->matriculaId,
            ]);
        for ($i=1; $i <= $matricula->comision->curso->cursoNroCuota ; $i++) { 
            # code...
            Cuota::create([
                'cuotaConcepto'     => 'Cuota '.$i.' - '.$matricula->comision->curso->cursoNombre,
                'cuotaMonto'        => $matricula->comision->curso->cursoCostoMes,
                'cuotaFVencimiento' => $nuevafecha,
                'cuotaBonificacion' => 0,
                'matriculaId'       => $matricula->matriculaId,
                ]);
            $nuevafecha = strtotime ( '+'.$i.' month' , strtotime ( $matricula->comision->comisionFI ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
        }
        return redirect()
        ->route('alumnos.cuotas', $matricula);/** */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
