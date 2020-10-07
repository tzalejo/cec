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
        /**
         * El orden del metodo BelongsToMany():
         *
         * Modelo a relacionar : Curso::class
         * Nombre de la tabla pivot: 'curso_nombre'
         * Llave foranea del modelo q realiza la relacion: 'materiaId'
         * Llave foranea del modelo a relacionar: 'cursoId'
         *
         */
        return $this->belongsToMany(Curso::class, 'curso_materia', 'materiaId', 'cursoId');
    }

    /**
     * Uso de Mutadores
     *
     */
    public function setMateriaNombreAttribute($valor)
    {
        $this->attributes['materiaNombre'] =  ucwords(strtolower($valor));
    }
}
