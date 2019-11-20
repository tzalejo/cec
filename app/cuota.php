<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pago;
use App\Matricula;

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
        return $this->hasMany(Pago::class, 'cuotaId');
    }

    public function cuotaFaltante()
    {
        /**
         * return el faltante de una cuota parcialmente pagada;
         *
         */
        return ($this->cuotaMonto - Pago::where('cuotaId', $this->cuotaId)->sum('pagoAbono'));
    }

    public function cuotaPagada()
    {
        /**
         * return Pago::where('cuotaId',$this->cuotaId)->sum('pagoAbono');
         * $sumatoriaCuota = Pago::sum('pagoAbono')->where('cuotaId',$this->cuotaId);
         */
        $montoPago = Pago::where('cuotaId', $this->cuotaId)->sum('pagoAbono');
        return $this->cuotaMonto == $montoPago;
    }
    public function estadoCuota()
    {
        /**
         *  Generar los estados de la cuota(Pagos):
         *  Cuota Pagada        : Fecha
         *  Cuota No pagada     : N/A
         *  Cuota Pago Parcial  : Fecha - Faltante
         */
        $now = date('Y-m-d');
        if ($this->cuotaPagada()) {
            # si la cuota esta saldada
            return Pago::where('cuotaId', $this->cuotaId)
            ->value('pagoFAbono');
            // ->get()
            // ->last() // para obtener el último elemento de la colección
        }
        if ($this->cuotaMonto > Pago::where('cuotaId', $this->cuotaId)->sum('pagoAbono') && $this->cuotaFVencimiento<= $now) {
            # si la cuota aun no fue salda y tiene un pago parcial
            return 'Falta cancelar: $'.(string)($this->cuotaMonto-(Pago::where('cuotaId', $this->cuotaId)->sum('pagoAbono')));
        } else {
            # si la cuota no esta pagada
            return 'No vencida - $'.(string)($this->cuotaMonto-(Pago::where('cuotaId', $this->cuotaId)->sum('pagoAbono')));
        }
    }
}
