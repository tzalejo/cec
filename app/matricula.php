<?php

namespace App;

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
     * 
     * 
     * @var colection
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::Class, 'estudianteId');
    }

}
