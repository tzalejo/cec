<?php

namespace Tests\Feature;

use App\Estudiante;
use App\Matricula;
use App\Comision;
use App\Curso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class MatriculaModuleTest extends TestCase
{
    use RefreshDatabase; # para actualiza la base con la base_test(realiza las migraciones)

    public function test_crear_una_matricula()
    {
        $this->withoutMiddleware();

        factory(Curso::class)->create();
        factory(Estudiante::class)->create();
        factory(Comision::class)->create();
        $matricula = factory(Matricula::class)->make()->toArray();
        $this->post('api/matricula',$matricula)
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function test_validacion_de_los_request_para_crear_o_modificar_un_matricula()
    {
        $this->assertTrue(true);
        return [
            'Requiere la situacion de la Matricula' => ['matriculaSituacion', null],
            'Requiere el Estudiante' => ['estudianteId', null],
            'Requiere el Comision' => ['comisionId', null],
            'Requiere un numero del Estudiante' => ['estudianteId', 'no_es_un_numero'],
            'Requiere un numero de la Comision' => ['comisionId', 'no_es_un_numero'],
        ];
    }

     /**
     * @dataProvider test_validacion_de_los_request_para_crear_o_modificar_un_matricula
     */
    public function test_validacion_request_store_en_matricula(
        string $campo,
        $valor
    ){
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        factory(Comision::class)->create();
        factory(Estudiante::class)->create();

        $matricula = factory(Matricula::class)->make([$campo => $valor]);
        $this->post('api/matricula/',$matricula->toArray())
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors($campo);
    }

    public function test_para_modificar_una_matricula()
    {
        $this->withoutMiddleware();
        // creo los modelos necesario
        factory(Curso::class)->create();
        factory(Estudiante::class)->create();
        $comision = factory(Comision::class, 3)->create()->toArray();
        // creo una matricula
        $matricula = factory(Matricula::class)->create(
            ['comisionId' => $comision[0]['comisionId'] ]
        )->toArray();
        $this->put(sprintf('api/matricula/%s', $matricula['matriculaId']), [
            'comisionId' => $comision[1]['comisionId'],
            'estudianteId' =>  $matricula['estudianteId'],
            'matriculaSituacion' =>  $matricula['matriculaSituacion']])
            ->assertStatus(Response::HTTP_OK);
        $this->assertEquals($comision[1]['comisionId'], Matricula::findOrFail($matricula['matriculaId'])->toArray()['comisionId']);
    }

    /**
     * @dataProvider test_validacion_de_los_request_para_crear_o_modificar_un_matricula
     */
    public function test_para_validacion_el_request_en_update_de_matricula(
        string $campo,
        $valor
    ){
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        factory(Comision::class)->create();
        factory(Estudiante::class)->create();

        $matricula = factory(Matricula::class)->create()->toArray();
        $matricula[$campo] = $valor;
        $this->put(sprintf('api/matricula/%s', $matricula['matriculaId']), $matricula)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors($campo);
    }


}
