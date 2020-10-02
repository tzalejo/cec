<?php

namespace App\Http\Controllers\Comision;

use App\Comision;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\DestroyComisionRequest;
use App\Http\Requests\StoreComisionRequest;
use App\Http\Requests\UpdateComisionRequest;
use App\Repositories\Comision\ComisionRepository;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Log;
# para usar validator
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComisionController extends ApiController
{
    use ApiResponser;
    private $comisionRepository;

    public function __construct(ComisionRepository $comisionRepository){
        $this->comisionRepository  = $comisionRepository;
    }

    /**
     * Devuelvo todas las comisiones
     *  - no activas con fecha de inicio desde hasta
     *  - sin filtro
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->comisionRepository
                    ->getComisionCursoMatricula()
                    ->ComisionesActivas()
                    ->get();;
    }

    public function indexComisionesInactivas( $fechaDesde, $fechaHasta){
        return $this->comisionRepository
                    ->getComisionCursoMatricula()
                    ->ComisionesInactivas()
                    ->ComisionesFechaDesde($fechaDesde)
                    ->ComisionesFechaHasta($fechaHasta)
                    ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreComisionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComisionRequest $request)
    {
        $this->comisionRepository->create($request->all());
        return $this->successResponse('Comision fue creada correctamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show($comisionId)
    {
        $resultado = $this->comisionRepository
                        ->getComisionCursoMatricula()
                        ->ComisionesActivas()
                        ->find($comisionId);
        return $this->successResponse($resultado, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateComisionRequest  $request
     * @param  Number  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComisionRequest $request, $comision)
    {
        $comisionBuscada = $this->comisionRepository->find($comision);
        $this->comisionRepository->update($comisionBuscada, $request->all());
        return $this->successResponse('Comision fue modificada correctamente', 200);

    }

    /**
     * DestroyComisionRequest: Viene de request porque validamos si existe la comision y si tiene matriculas
     *
     * @param  App\Http\Requests\DestroyComisionRequest  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyComisionRequest $comision)
    {
        $comisionEliminar = $this->comisionRepository->find($comision->comisionId);
        $this->comisionRepository->delete($comisionEliminar);
        return $this->successResponse('Comision fue eliminada correctamente',200);
    }
}
