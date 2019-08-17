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
        return $this->hasMany(Matricula::class,'estudianteId');
    }

    /**
     * query scope
     * 
     */
    public function scopeEstudianteApellido($query, $estudianteApellido){
        if(trim($estudianteApellido))
            return $query->where('estudianteApellido', 'LIKE' , "%$estudianteApellido%");
        
    }

    /**
     * Devuelve la cantidad de matriculas tiene el estudiante..
     * 
     * @var number
     */
    public function cantidadMatriculas(){
        return Matricula::where('estudianteId',$this->estudinteId)->count();
    }

    
}
