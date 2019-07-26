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

    public function obtenerCurso(){
        return Curso::where('cursoId',$this->cursoId)->value('cursoNombre');
    }
    // me devuelve si la funcion esta activa o no, osea la fecha de fin 
    public function comisionActiva(){
        $now = new \DateTime();
        return ($this->comisionFF < $now);
    }

}
