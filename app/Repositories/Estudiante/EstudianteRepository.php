<?php

namespace App\Repositories\Estudiante;

use App\Estudiante;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
class EstudianteRepository extends BaseRepository {

    public function getModel()
    {
        return new Estudiante();
    }

    public function getEstudianteDniApellido($dni = null, $apellido = null)
    {
        return $this->getModel()
                ->with('matriculas.comision.curso')
                ->Apellido($apellido)   # utilizamos scope
                ->DNI($dni)             # utilizamos scope
                ->orderBy('estudianteApellido','ASC')
                ->get();
    }
}
