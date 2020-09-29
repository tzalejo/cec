<?php

namespace App;

use App\Matricula;
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
        return $this->hasMany(Matricula::class, 'estudianteId');
    }

    /**
     * query scope por Apellido
     */
    public function scopeApellido($query, $estudianteApellido)
    {
        if (trim($estudianteApellido)) {
            return $query->where('estudianteApellido', 'LIKE', $estudianteApellido.'%');
        }
    }

    /**
     * query scope por DNI
     */
    public function scopeDNI($query, $estudianteDNI)
    {
        if (trim($estudianteDNI)) {
            return $query->where('estudianteDNI', 'LIKE', $estudianteDNI.'%');
        }
    }

    /**
     * Devuelve la cantidad de matriculas tiene el estudiante..
     *
     * @var number
     */
    public function cantidadMatriculas()
    {
        return Matricula::where('estudianteId', $this->estudinteId)->count();
    }

    # uso de mutadores
    public function setEstudianteNombreAttribute($valor)
    {
        $this->attributes['estudianteNombre'] =  ucwords(strtolower($valor));
    }
    public function setEstudianteApellidoAttribute($valor)
    {
        $this->attributes['estudianteApellido'] =  ucwords(strtolower($valor));
    }
    public function setEstudianteDomicilioAttribute($valor)
    {
        $this->attributes['estudianteDomicilio'] =  ucwords(strtolower($valor));
    }
    public function setEstudianteEmailAttribute($valor)
    {
        $this->attributes['estudianteEmail'] =  strtolower($valor);
    }
    public function setEstudianteLocalidadAttribute($valor)
    {
        $this->attributes['estudianteLocalidad'] =  strtolower($valor);
    }
}
