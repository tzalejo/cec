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

    /**
     * Funcion para saber si una matricula cancelo todas las cuotas.
     * 
     * @var boolean
     */
    public function matriculaCancelada(){
        $cantidadCuotas = $this->comision->curso->cursoNroCuota; 

        // obtengo un arreglo de todas las cuotas con matriculaId
        $cuotas = Cuota::where('matriculaId',$this->matriculaId)->get();
        
        // recorro las cuotas y verifico si estan pagadas o no..
        for ($i=1; $i <= $cantidadCuotas ; $i++) { 
            # code...
            if (!$cuotas[$i]->cuotaPagada()) {
                # si alguna cuota no fue pagada retorno false..
                return false;
            }
        }
        // fue pagada si llego aca..
        return true;
    }

}
