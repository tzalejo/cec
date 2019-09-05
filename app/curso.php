<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
     /**
     * 
     * si queremos desactivar los campos de creacion y actualizacion
     * que se crean automaticamente al crear una tabla
     * 
     */
    public $timestamps = false;
    
    protected $primaryKey = 'cursoId';

    /**
    * Estoy indicando la relacion comision tiene muchas matriculas('s' de muchos).
    * Usando tinker $curso= Curso::first()
    * $curso->comisiones; -> esto me devuelve las comisiones relacionado a la curso.
    * @var array 
    */
    public function comisiones(){
        return $this->hasMany(Comision::class,'cursoId');
    }

    public function materias(){
        return $this->belongsToMany(Materia::class, 'curso_materia','cursoId','materiaId');
    }
}
