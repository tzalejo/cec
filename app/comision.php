<?php

namespace App;
use App\Matricula;
use App\Curso;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = 'comisiones';

    /**
     * 
     * si queremos desactivar los campos de creacion y actualizacion
     * que se crean automaticamente al crear una tabla
     * 
     */
    public $timestamps = false;
    
    protected $primaryKey = 'comisionId';

     /**
     * Estoy indicando que un Comision pertenece a un curso.
     * Usando tinker $comsion= Comision::first()
     * $comsion->curso; -> esto me devuelve el curso relacionado a la comision (primera).
     * @var array 
     */
    public function curso(){
        return $this->belongsTo(Curso::class,'cursoId');
    }
    
    // funcion que me devuelve la cantidad de alumnos que tiene una comision..
    public function cantidadAlumnos(){
        return Matricula::where('comisionId',$this->comisionId)->count();
    }

    /**
     * Devuelve el nombre del curso, segun la comision seleccionadad. Tinker:
     * $comision = Comision::all()->first();
     * $comision->obtenerCurso() --> "SJCC"
     * 
     * @return string
     */
    public function obtenerCurso(){
        return Curso::where('cursoId',$this->cursoId)->value('cursoNombre');
    }
    
    /**
     * Me devuelve si la funcion esta activa o no, osea la fecha de fin. Tinker:
     * 
     * 
     */
    // public function comisionesActivas(){
    //     $now = date('Y-m-d');
    //     return Comision::where('comisionFF', '>', $now)->get();
    // }

}
