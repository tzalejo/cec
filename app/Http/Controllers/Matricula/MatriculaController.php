<?php

namespace App\Http\Controllers\Matricula;

use App\Matricula;
use App\Cuota;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Traits\ApiResponser;

class MatriculaController extends ApiController
{
    use ApiResponser;
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
        return $this->showOne($matricula, 200);
        
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
        //
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
