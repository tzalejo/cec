<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
     /**
     * 
     * si queremos desactivar los campos de creacion y actualizacion
     * que se crean automaticamente al crear una tabla
     * 
     */
    public $timestamps = false;
    
    protected $primaryKey = 'estudianteId';

    protected $fillable =[
        'estudianteNombre',
        'estudianteApellido',
        'estudianteDNI',
        'estudianteDomicilio',
        'estudianteEmail',
        'estudianteTelefono',
        'estudianteLocalidad',
        'estudianteNacimiento',
        'estudianteFoto',
    ];

    /**
     * Indico la relacion que un estudiante puede tener muchas matriculas('s' de muchas)
     * Tinker:
     * $estudiante= App\Estudiante::first()
     * $estudiante->matriculas
     * 
     * @var colection
     */

    public function matriculas()
    {
        return $this->hasMany(Matricula::class,'matriculaId');
    }
    
}
