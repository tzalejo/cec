<?php

namespace App\Http\Controllers\Matricula;

use App\Matricula;
use App\Cuota;
use App\Estudiante;
use App\Comision;
use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
class MatriculaController extends ApiController
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apellido = $request->get('estudianteApellido');
        $DNI = $request->get('estudianteDNI');
        $estudiante = Estudiante::has('matriculas')             # has: limitar sus resultados en función de la existencia de una relación
                        ->with('matriculas.comision.curso')     
                        ->estudianteApellido($apellido)         # utilizamos scope
                        ->estudianteDNI($DNI)                   # utilizamos scope
                        ->get();
                        // ->paginate(10); 
        return $this->successResponse($estudiante, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # viene de altaReinscripcionEstudiante
        # Recordar: regular(RE), no regular(NR) o egresado(EG)
        $matricula =  Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'      =>$request->get('estudianteId'),
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
            $nuevafecha = strtotime('+'.$i.' month', strtotime($matricula->comision->comisionFI)) ;
            $nuevafecha = date('Y-m-j', $nuevafecha);
        }
        return $this->showOne($matricula,201);
        // return redirect()
        // ->route('alumnos.cuotas', $matricula);/** */
    }

    /**
     *
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        # validar que exista la matricula..
        $this->showOne($matricula, 200);
        
        // return $request->validate([
        //     'matriculaId'      => 'required|numeric']);
            
        // if ($datosValidado->fails()) {
        //     $errors = $datosValidado->errors();
        //     // return $this->errorResponse('Error en la validacion del formulario, verifique',400);
        //     # retorno error 400..
        //     return $this->errorResponse($errors,400);
        // }
        // $matriculaId =$request->get('matriculaId');
        // $matricula = Matricula::where('matriculaId',$matriculaId)->get();
        // return $this->showOne($matriculaId);
        
        
        // $now = date('Y-m-d');
        // $estudiante = $matricula->estudiante;
        // $comisionesAbiertas = Comision::where('comisionFF', '>', $now)->get();
        // $miComision = $matricula->comision; # envio la comision de la matricula
        
        // return view('alumnos.editar')
        // ->with('estudiante',$estudiante)
        // # envio la matricula para luego modificar la  comsion de esa matricula
        // ->with('matricula',$matricula->matriculaId)
        // ->with('comisionesAbiertas',$comisionesAbiertas)
        // ->with('miComision',$miComision);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matricula $matricula)
    {
        // return $request;
        $datosValidos =  Validator::make($request->all(),[
            'matriculaSituacion'=>'required',
            'estudianteId'      =>'required|numeric',
            'comisionId'        =>'required|numeric' ,
        ],[
            'matriculaSituacion.required' => 'La Situacion es requerido',
            'estudianteId.required' => 'El estudiante es requerido',
            'comisionId.required' => 'La comision es requerida',
        ]);

        # verifico si hubo errores en la validaciones..
        if ($datosValidos->fails()) {
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }

        # actualizo
        $matricula->update([
            'matriculaSituacion' => $request->matriculaSituacion,
            'estudianteId'       => $request->estudianteId,
            'comisionId'         => $request->comisionId ,
        ]);

        return $this->successResponse('Matricula fue modificada correctamente', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricula $matricula)
    {
        # dd($matricula->estudiante);
        # Se elimina logicamente ( no regular: NR )..
        # Dejaremos los datos del estudiante..
        $matricula->matriculaSituacion = 'NR';
        $matricula->update();
        
        # dd(Auth::user()->userNombre);
        return redirect()->route('home');
    }
}
