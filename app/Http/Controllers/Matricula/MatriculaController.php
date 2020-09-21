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
use App\Http\Requests\UpdateMatriculaRequest;
use App\Http\Requests\StoreMatriculaRequest;

class MatriculaController extends ApiController
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {}

    /**
     * Matriculo al estudiante
     * Tambien se dispara matriculaObserver(created)
     * Recordar: regular(RE), no regular(NR) o egresado(EG)
     *
     *
     * @param  App\Http\Requests\StoreMatriculaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatriculaRequest $request)
    {
        $matricula =  Matricula::create([
            'matriculaSituacion'=>'RE',
            'estudianteId'      =>$request->estudianteId,
            'comisionId'        =>$request->comisionId,
        ]);

        return $this->showOne($matricula,201);



        // for ($i=1; $i <= $matricula->comision->curso->cursoNroCuota ; $i++) {
        //     # code...
        //     Cuota::create([
        //         'cuotaConcepto'     => 'Cuota '.$i.' - '.$matricula->comision->curso->cursoNombre,
        //         'cuotaMonto'        => $matricula->comision->curso->cursoCostoMes,
        //         'cuotaFVencimiento' => $matricula->comision->comisionFI,
        //         'cuotaBonificacion' => 0,
        //         'matriculaId'       => $matricula->matriculaId,
        //         ]);
        //     $nuevafecha = strtotime('+'.$i.' month', strtotime($matricula->comision->comisionFI)) ;
        //     $nuevafecha = date('Y-m-j', $nuevafecha);
        // }
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
     * @param  App\Http\Requests\UpdateMatriculaRequest  $request
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatriculaRequest $request, Matricula $matricula)
    {
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
