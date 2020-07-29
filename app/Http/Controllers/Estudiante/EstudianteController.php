<?php

namespace App\Http\Controllers\Estudiante;

use App\Estudiante;
use App\Comision;
use App\Matricula;
use App\Cuota;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Traits\ApiResponser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
        return Estudiante::query()->orderBy('estudianteApellido','ASC')->get();
    }

    /**
     *  guardo los datos del formulario de inscripcion(del estudiante)..Estudiante $estudiante,
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstudianteRequest $request)
    {
        
        # creo el estudiante, con su respectiva matricula
        $estudianteNuevo = Estudiante::create([
            'estudianteNombre'      => ucwords(strtolower($request->estudianteNombre)),
            'estudianteApellido'    => ucwords(strtolower($request->estudianteApellido)),
            'estudianteDNI'         => $request->estudianteDNI,
            'estudianteDomicilio'   => ucwords(strtolower($request->estudianteDomicilio)),
            'estudianteEmail'       => strtolower($request->estudianteEmail),
            'estudianteTelefono'    => $request->estudianteTelefono,
            'estudianteLocalidad'   => strtolower($request->estudianteLocalidad),
            'estudianteNacimiento'  => $request->estudianteNacimiento,
            'estudianteFoto'        => $request->estudianteFoto,
        ]);
        
        // return ($request->get('pagoInscripcion') && $request->get('pagoCuota'));
        # pregunto por las casillas, pero siempre va al else por como tengo el formulario(que puede que se tenga q cambiar)
        if ($request->get('pagoInscripcion') || $request->get('pagoCuota')) {
            # Recordar: regular(RE), no regular(NR) o egresado(EG)
            $matricula =  Matricula::create([
                'matriculaSituacion'=>'RE',
                'estudianteId'      =>$estudianteNuevo->estudianteId ,
                'comisionId'        =>$request->get('comisionId') ,
            ]);
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
                $nuevafecha = strtotime('+'.$i.' month', strtotime($matricula->comision->comisionFI)) ;
                $nuevafecha = date('Y-m-j', $nuevafecha);
            }
            # return redirect()->route('alumnos.cuotas', $matricula);
            return $this->showOne($matricula);
        } else {
            # es porque ninguna de las dos casilla esta tildada..
        # return view('home')->with('comisiones', Comision::all());
        return $this->successResponse(null, 200); # devuelvo '0' para saber q solo se inscribio y no se matriculo(pago inscripcion y/o cuota)
        }
    }
    /**
     * Este api lo usabaa para filtrado por DNI y/o por apellido.
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
        ->orderBy('estudianteId', 'ASC')
        ->paginate(10);
        
        # return view('alumnos.mostrar')->with('estudiantes', $estudiantes);
        # devuelve el estudiante con sus matriculas
        // return response()->json($estudiantes, 200);
        return $this->successResponse($estudiantes, 200);
    }

    /**
     * Actualizo los datos del estudiante y tambien el comision de la matricula enviada..
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstudianteRequest $request, Estudiante $estudiante)
    {
        # ver el tema de las cuotas si hay cambio..                    *Falta!*
        # actualizar Estudiante y matricula(comision)
        $matricula = Matricula::find($request->get('matricula'));# busco la matricula
        $matricula->comisionId = $request->get('comisionId'); # modifico con la nueva comsion
        $matricula->save();
        // return response()->json( is_null($request->get('estudianteFoto')), 200);
        
        # aca especifico el mensaje d cierto error.
        if (is_null($request->get('estudianteFoto'))) {
            $estudiante->update([
                'estudianteNombre'      => ucwords(strtolower($request['estudianteNombre'])),
                'estudianteApellido'    => ucwords(strtolower($request['estudianteApellido'])),
                'estudianteDNI'         => $request['estudianteDNI'],
                'estudianteDomicilio'   => ucwords(strtolower($request['estudianteDomicilio'])),
                'estudianteEmail'       => $request['estudianteEmail'],
                'estudianteTelefono'    => $request['estudianteTelefono'],
                'estudianteLocalidad'   => strtolower($request['estudianteLocalidad']),
                'estudianteNacimiento'  => $request['estudianteNacimiento'],
                # verifico si viene la foto null no modifico caso contrario agrego el nueva imagen..
                # 'estudianteFoto'        => $request['estudianteFoto'], xq no se modifico la imagien
            ]);
        } else {
            # code...
            $estudiante->update([$request]);
        }
        # return redirect()->route('home');
        return $this->showOne($estudiante);
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
