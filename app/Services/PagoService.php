<?php

namespace App\Services;
use App\Pago;

class PagoService {
    private $pago;

    public function __construct(Pago $pago){
        $this->pago = $pago;
    }

    public function cuotaEstaPagada(){
        return $this->pago->cuota->cuotaPagada();
    }

    public function nuevaFechaDeVencimiento(){
        $nuevafecha = strtotime('+'.($this->pago->cuota->matricula->cuotas->count()-1).' month', strtotime($this->pago->cuota->matricula->comision->comisionFI));
        return date('Y-m-j', $nuevafecha);
    }

    public function esElMaximoDeCuotas(){
        return ($this->pago->cuota->matricula->comision->curso->cursoNroCuota >= ($this->pago->cuota->matricula->cuotas->count()));
    }

    public function nombreDeLaCuota(){
        return 'Cuota '.($this->pago->cuota->matricula->cuotas->count()).' - '.$this->pago->cuota->matricula->comision->curso->cursoNombre;
    }

    public function costoPorMes(){
        return $this->pago->cuota->matricula->comision->curso->cursoCostoMes;
    }

    public function matriculaDeLaCuota(){
        return $this->pago->cuota->matricula->matriculaId;
    }

}
