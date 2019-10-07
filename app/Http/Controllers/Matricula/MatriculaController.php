<?php

namespace App\Http\Controllers\Matricula;

use App\Matricula;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class MatriculaController extends ApiController
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        // $matriculaId = $request->validate([
        //     'matriculaId'      => 'required|numeric']);

        // $matricula = Matricula::where('matriculaId',$matriculaId)->get();
        $now = date('Y-m-d');
        $estudiante = $matricula->estudiante;
        $comisionesAbiertas = Comision::where('comisionFF', '>', $now)->get();
        $miComision = $matricula->comision; # envio la comision de la matricula
        
        return view('alumnos.editar')
        ->with('estudiante',$estudiante)
        # envio la matricula para luego modificar la  comsion de esa matricula
        ->with('matricula',$matricula->matriculaId) 
        ->with('comisionesAbiertas',$comisionesAbiertas)
        ->with('miComision',$miComision);
        
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
