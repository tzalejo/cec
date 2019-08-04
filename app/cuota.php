<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Matricula;
use App\Pago;
class Cuota extends Model
{
     /**
     * 
     * si queremos desactivar los campos de creacion y actualizacion
     * que se crean automaticamente al crear una tabla
     * 
     */
    public $timestamps = false;
    /**
     * No me deja crear Cuota si no tengo el fillable
     * 
     */
    protected $fillable=[
        'cuotaId',
        'cuotaConcepto',
        'cuotaMonto',
        'cuotaFVencimiento',
        'cuotaBonificacion',
        'matriculaId',
    ];
    protected $primaryKey = 'cuotaId';

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matriculaId');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::Class, 'cuotaId');
    }

    public function cuotaPagada(){
        // return Pago::where('cuotaId',$this->cuotaId)->sum('pagoAbono');
        // $sumatoriaCuota = Pago::sum('pagoAbono')->where('cuotaId',$this->cuotaId);
        return $this->cuotaMonto == Pago::where('cuotaId',$this->cuotaId)->sum('pagoAbono');
    }
}
