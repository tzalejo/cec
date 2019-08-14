<?php

namespace App;
use App\Estudiante;
use App\Comision;
use App\Cuota;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
     /**
     * 
     * si queremos desactivar los campos de creacion y actualizacion
     * que se crean automaticamente al crear una tabla
     * 
     */
    public $timestamps = false;
    
    protected $primaryKey = 'matriculaId';
    
    protected $fillable=[
        'matriculaSituacion',
        'estudianteId',
        'comisionId',
    ];

    /**
     * Indico la relacion Matricula tiene un y solo un alumno
     * 
     * @var colection
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::Class, 'estudianteId');
    }

    /**
     * Relacion una matricula tien una y solo una  comision
     * 
     * @var colection
     */
    public function comision()
    {
        return $this->belongsTo(Comision::class, 'comisionId');
    }

    /**
     * Relacion 
     * 
     * @var colection
     */
    public function cuotas()
    {
        return $this->hasMany(Cuota::class, 'matriculaId');
    }


    /**
     * Funcion si una matricula esta regular(RE) o no regular(eliminada-NR)
     * 
     * @var boolean
     */
    public function esMatriculaRegular(){
        return $this->matriculaSituacion == 'RE';
    }

}
