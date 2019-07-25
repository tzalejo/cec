<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
     /**
     * 
     * si queremos desactivar los campos de creacion y actualizacion
     * que se crean automaticamente al crear una tabla
     * 
     */
    public $timestamps = false;
    
    protected $primaryKey = 'comisionId';

}
