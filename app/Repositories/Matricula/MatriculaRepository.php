<?php

namespace App\Repositories\Matricula;

use App\Matricula;
use App\Repositories\BaseRepository;

class MatriculaRepository extends BaseRepository {

    public function getModel(){
        return new Matricula();
    }
}
