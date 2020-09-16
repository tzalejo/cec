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

    protected $fillable = [
        'comisionNombre',
        'comisionHorario',
        'comisionFI',
        'comisionFF',
        'cursoId',
    ];

    /**
    * Estoy indicando que un Comision pertenece a un curso.
    * Usando tinker $comsion= Comision::first()
    * $comsion->curso; -> esto me devuelve el curso relacionado a la comision (primera).
    * @var array
    */
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'cursoId');
    }

    /**
    * Estoy indicando la relacion comision tiene muchas matriculas('s' de muchos).
    * Usando tinker $comision= Comision::first()
    * $comision->matriculas; -> esto me devuelve las matriculas relacionado a la comision.
    * @var array
    */
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'comisionId');
    }

    // funcion que me devuelve la cantidad de alumnos que tiene una comision..
    public function cantidadAlumnos()
    {
        return Matricula::where('comisionId', $this->comisionId) // query()
        ->where('matriculaSituacion', 'RE')
        ->count();
    }

    /**
     * Devuelve el nombre del curso, segun la comision seleccionadad. Tinker:
     * $comision = Comision::all()->first();
     * $comision->obtenerNombreCurso() --> "SJCC"
     *
     * @return string
     */
    public function obtenerNombreCurso()
    {
        return Curso::where('cursoId', $this->cursoId)
                ->value('cursoNombre');
    }

    public function obtenerAlumnos()
    {
        return Matricula::where('comisionId', $this->comisionId)
        ->with('estudiante') // para generar menos queries
        ->where('matriculaSituacion', 'RE') // Solo los regulares
        ->get();
    }

    /**
     *  scope Comisiones
     */
    public function scopeComisionesActivas($query)
    {
        $now = date('Y-m-d');
        return $query->where('comisionFF', '>=', $now);
    }

    public function scopeComisionesInactivas($query)
    {
        $now = date('Y-m-d');
        return $query->where('comisionFF', '<', $now);
    }
    /**
     *  scope Comisiones con fecha de inicio
     */
    public function scopeComisionesFechaDesde($query, $fechaDesde)
    {
        return $query->where('comisionFI', '>=', $fechaDesde);
    }
    /**
     *  scope Comisiones con fecha de fin
     */
    public function scopeComisionesFechaHasta($query, $fechaHasta)
    {
        return $query->where('comisionFI', '<=', $fechaHasta);
    }
}
