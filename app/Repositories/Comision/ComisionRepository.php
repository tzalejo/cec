<?php
namespace App\Repositories\Comision;

use App\Comision;
use App\Repositories\BaseRepository;

class ComisionRepository extends BaseRepository {

    public function getModel()
    {
        return new Comision();
    }
    public function getComisionCursoMatricula(){
        return $this->getModel()
        ->with('curso')
        ->with('matriculas.estudiante')
        ->withCount('matriculas')
        ->orderBy('cursoId', 'ASC');
    }

}
