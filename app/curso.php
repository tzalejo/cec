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

    protected $fillable=[
        'cursoNombre',
        'cursoNroCuota',
        'cursoCostoMes',
        'cursoInscripcion',
    ];

    protected $primaryKey = 'cursoId';

    /**
    * Estoy indicando la relacion comision tiene muchas matriculas('s' de muchos).
    * Usando tinker $curso= Curso::first()
    * $curso->comisiones; -> esto me devuelve las comisiones relacionado a la curso.
    * @var array
    */
    public function comisiones()
    {
        return $this->hasMany(Comision::class, 'cursoId');
    }

    public function materias()
    {
        /**
         * El orden del metodo BelongsToMany():
         *
         * Modelo a relacionar : Materia::class
         * Nombre de la tabla pivot: 'curso_nombre'
         * Llave foranea del modelo q realiza la relacion: 'cursoId'
         * Llave foranea del modelo a relacionar: 'materiaId'
         *
         */
        return $this->belongsToMany(Materia::class, 'curso_materia', 'cursoId', 'materiaId');
    }

    /**
     * Query scope para Ordernar por Campo
     */
    public function scopeOrderByCampo($query, $campo)
    {
        return $query->orderBy($campo);
    }

    /**
     * Uso de Mutadores
     */
    public function setCursoNombreAttribute($valor)
    {
        $this->attributes['cursoNombre'] =  ucwords(strtolower($valor));
    }
}
