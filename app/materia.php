<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /**
    *
    * si queremos desactivar los campos de creacion y actualizacion
    * que se crean automaticamente al crear una tabla
    *
    */
    public $timestamps    = false;

    protected $fillable   = ['materiaNombre', 'materiaSeminario'];
    protected $primaryKey = 'materiaId';

    /**
     * Relacion muchos a muchos materia <----> curso
     *
     *
     */
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_materia', 'materiaId', 'cursoId');
    }
}
