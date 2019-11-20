<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cuota;

class Pago extends Model
{
    protected $primaryKey = 'pagoId';
    protected $fillable = [
        'pagoId',
        'pagoAbono',
        'pagoFAbono',
        'cuotaId',
    ];

    /**
     *
     * si queremos desactivar los campos de creacion y actualizacion
     * que se crean automaticamente al crear una tabla
     *
     */
    public $timestamps = false;

    public function cuota()
    {
        return $this->belongsTo(Cuota::class, 'cuotaId');
    }
}
