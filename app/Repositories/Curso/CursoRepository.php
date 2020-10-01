<?php

namespace App\Repositories\Curso;

use App\Curso;
use App\Repositories\BaseRepository;

class CursoRepository extends BaseRepository {

    public function getModel()
    {
        return new Curso();
    }

    public function findCursoComisionActivas($curso)
    {
        return $this->getModel()
                ->with(['comisiones'=> function ($query) {
                            $query
                            ->OrderByCampo('comisionFI')
                            ->ComisionesActivas();
                        }])
                ->find($curso);
    }

    public function cursoTieneMateriaComision($curso)
    {
        return (
            $this->getModel()->find($curso)->materias->count() === 0 &&
            $this->getModel()->find($curso)->comisiones->count() === 0
        );
    }
}
