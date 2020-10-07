<?php

namespace App\Repositories\Materia;

use App\Curso;
use App\Materia;

use App\Repositories\BaseRepository;

class MateriaRepository extends BaseRepository {

    public function getModel()
    {
        return new Materia();
    }

    public function getMateriaPorCurso(Curso $curso){
        return $curso->materias;
    }
}
