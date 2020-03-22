<?php

namespace App\Http\Controllers\Comision;

use App\Comision;
use App\Matricula;
use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Traits\ApiResponser;
# para usar validator
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComisionController extends ApiController
{
    use ApiResponser;
    /**
     * Devuelvo todas las comisiones activas(que no se cerraron por las fechas)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # obtengo las comisiones activas,
        $comisionesActivas = Comision::ComisionesActivas()
                                ->with('curso') # para optimizar la consulta
                                ->with('matriculas') # para obtener los alumnos d esta comision
                                ->withCount('matriculas') # envio cantidad de matricula por comision..
                                ->get(); # uso un scope
        # devuelvo las comisiones
        # return response()->json([$comisionesActivas],200);
        return $this->showAll($comisionesActivas); # usamos metodos de Traits para devolver
        
        #########################
        # esto estaba en el home:
       
        #$comisiones = Comision::with('matriculas')
        #                    ->with('curso')
        #                    ->get();
        # envio a mi api
        #return response()->json($comisiones, 200);  # return view('home')->with('comisiones', $comisiones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // Validamos
        $datosValidos = Validator::make($request->all(),[
            'comisionNombre'    => 'required|min:3|max:150',
            'comisionHorario'   => 'required|min:3|max:150',
            'comisionFI'        => 'required|date',
            'comisionFF'        => '', # no la necesito validar porque se calcula 
            'cursoId'           => 'required|numeric',
        ],[
            'comisionNombre.required'       => 'El Nombre del comision es requerido',
            'comisionNombre.min'            => 'La cantidad min caracteres no son lo establecido, Verifique.',
            'comisionNombre.max'            => 'La cantidad max caracteres no son lo establecido, Verifique.',
            'comisionHorario.required'      => 'El Horarios es requerido',
            'comisionHorario.min'           => 'La cantidad min caracteres no son lo establecido, Verifique.',
            'comisionHorario.max'           => 'La cantidad max caracteres no son lo establecido, Verifique.',
            'comisionFI.required'           => 'La Fecha de Inicio es requerido',
            'comisionFI.date'               => 'La Fecha de Inicio no es valida',
            'cursoId.required'              => 'El curso es requerido',
        ]);

        # verifico si hubo errores en la validaciones..
        if ($datosValidos->fails()) {
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }

        # creo la comision
        $comisionNuevo = comision::create([
            'comisionNombre'    => strtoupper($request->comisionNombre),
            'comisionHorario'   => strtoupper($request->comisionHorario),
            'comisionFI'        => $request->comisionFI,
            'comisionFF'        => $request->comisionFF,
            'cursoId'           => $request->cursoId,
        ]);

         # retorno ok
         return $this->successResponse('Comision fue creada correctamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show(Comision $comision)
    {
        return $this->successResponse($comision, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comision $comision)
    {
        //
        $datosValidos = Validator::make($request->all(),[
            'comisionNombre'    => 'required|min:3|max:150',
            'comisionHorario'   => 'required|min:3|max:150',
            'comisionFI'        => 'required|date',
            'comisionFF'        => 'required|date', # no la necesito validar porque se calcula 
            'cursoId'           => 'required|numeric',
        ],[
            'comisionNombre.required'       => 'El Nombre del comision es requerido',
            'comisionNombre.min'            => 'La cantidad min caracteres no son lo establecido, Verifique.',
            'comisionNombre.max'            => 'La cantidad max caracteres no son lo establecido, Verifique.',
            'comisionHorario.required'      => 'El Horarios es requerido',
            'comisionHorario.min'           => 'La cantidad min caracteres no son lo establecido, Verifique.',
            'comisionHorario.max'           => 'La cantidad max caracteres no son lo establecido, Verifique.',
            'comisionFI.required'           => 'La Fecha de Inicio es requerido',
            'comisionFI.date'               => 'La Fecha de Inicio no es valida',
            'comisionFF.required'           => 'La Fecha de Inicio es requerido',
            'comisionFF.date'               => 'La Fecha de Inicio no es valida',
            'cursoId.required'              => 'El curso es requerido',
        ]);
        # verifico si hubo errores en la validaciones..
        if ($datosValidos->fails()) {
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }

        # actualizo
        $comision->update([
            'comisionNombre'    => strtoupper($request->comisionNombre),
            'comisionHorario'   => strtoupper($request->comisionHorario),
            'comisionFI'        => $request->comisionFI,
            'comisionFF'        => $request->comisionFF,
            'cursoId'           => $request->cursoId,
        ]);

         # retorno ok
         return $this->successResponse('Comision fue modificada correctamente', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comision $comision)
    {
        //
        // return $comision;
        $comision->delete();
        return $this->successResponse('Comision fue eliminada correctamente',200);
    }
}
