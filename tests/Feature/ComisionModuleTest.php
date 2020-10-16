<?php

namespace Tests\Feature;

use App\Comision;
use App\Curso;
use App\Estudiante;
use App\Matricula;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Faker\Generator as Faker;

class ComisionModuleTest extends TestCase
{
    use RefreshDatabase; # para actualiza la base con la base_test(realiza las migraciones)

    public function test_obtener_las_comisiones()
    {
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        factory(Comision::class, 4)->create();
        $this->get('api/comision')
            ->assertJsonCount(4)
            ->assertOk()
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_obtener_una_comision()
    {
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        $comision = factory(Comision::class)->create()->toArray();

        $this->get(sprintf('api/comision/%s',$comision['comisionId']))
            ->assertOk()
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                [
                    'comisionNombre' => $comision['comisionNombre'],
                    'comisionHorario' => $comision['comisionHorario'],
                    'comisionFI' => $comision['comisionFI'],
                    'comisionFF' => $comision['comisionFF'],
                    'cursoId' => $comision['cursoId'],
                    'comisionId' => $comision['comisionId'],
                ]
            );
    }

    public function test_obtener_todas_las_comisiones_inactivas_con_fecha_de_inicio_desde_hasta()
    {
        $this->withoutMiddleware();
        factory(Curso::class, 3)->create();
        factory(Comision::class)->create([
                'comisionNombre' => 'Comision 41',
                'comisionHorario' => 'Wednesday 02:33:54',
                'comisionFI' => '2018-10-15',
                'comisionFF' => '2019-07-15',
                'cursoId' => 1,
                'comisionId' => 1,
        ]);
        factory(Comision::class)->create([
                'comisionNombre' => 'Comision 42',
                'comisionHorario' => 'Wednesday 02:33:54',
                'comisionFI' => '2017-10-15',
                'comisionFF' => '2018-07-15',
                'cursoId' => 3,
                'comisionId' => 2,
        ]);
        factory(Comision::class)->create([
                'comisionNombre' => 'Comision 43',
                'comisionHorario' => 'Wednesday 02:33:54',
                'comisionFI' => '2020-10-15',
                'comisionFF' => '2021-07-15',
                'cursoId' => 3,
                'comisionId' => 3,
        ]);

        $this->get(sprintf('api/comision/%s/%s/inactivas',
            Carbon::parse('2016-01-15')->format('Y-m-d'),
            Carbon::parse( '2018-07-15')->format('Y-m-d')))
            ->assertOk()
            ->assertJsonCount(1)
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_obtener_las_comisiones_inactivas_con_fechas_desde_hasta_invalidas()
    {
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        factory(Comision::class)->create();
        $this->get('api/comision/fecha_invalida/fecha_invalida')
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_crear_una_comision()
    {
        $this->withoutMiddleware();
        $this->withoutExceptionHandling();
        factory(Curso::class)->create();
        $comision = factory(Comision::class)->make([
            'comisionNombre' => 'Comision de Prueba',
            'comisionHorario' => 'Wednesday 02:33:54',
            'comisionFI' => '2017-10-15',
            'comisionFF' => '2018-07-15',
            'cursoId' => 1
            ])->toArray();

        $this->post('api/comision', $comision)
            ->assertStatus(Response::HTTP_CREATED);
        $this->assertCount(1, Comision::all());
    }

    public function test_validacion_de_los_request_para_crear_un_comision()
    {
        $this->assertTrue(true);
        return [
            'Requiere el campo Nombre' => ['comisionNombre', null],
            'El campo Nombre tiene como maximo 150 caracteres' => ['comisionNombre', 'El campo Nombre tiene como maximo 150 caracteresEl campo Nombre tiene como maximo 150 caracteresEl campo Nombre tiene como maximo 150 caracteresEl campo Nombre tiene como maximo 150 caracteres'],
            'El campo Nombre requiere como minimo 3 caracteres' => ['comisionNombre', 'ab'],

            'Requiere el campo Horario' => ['comisionHorario', null],
            'El campo Horario tiene como maximo 50 caracteres' => ['comisionHorario',  'El campo Nombre tiene como maximo 150 caracteresEl campo Nombre tiene como maximo 150 caracteresEl campo Nombre tiene como maximo 150 caracteres El campo Nombre tiene como maximo 150 caracteres'],
            'El campo Horario requiere como minimo 3 caracteres' => ['comisionHorario', 'ab'],

            'Requiere el campo Fecha de Inicio' => ['comisionFI', null],
            'El valor del campo Fecha de Inicio es incorrecto' => ['comisionFI', 'valor_invalido'],

            'Requiere el campo Fecha de Fin' => ['comisionFF', null],
            'El valor del campo Fecha de Fin es incorrecto' => ['comisionFF', 'valor_invalido'],

            'Requiere el campo Curso ' => ['cursoId', null],
            'El valor del campo Curso es incorrecto' => ['cursoId', 'valor_invalido'],
        ];
    }

    /**
     * @dataProvider test_validacion_de_los_request_para_crear_un_comision
     */
    public function test_validacion_request_al_crea_una_comision(
        string $campo,
        $valor
    ){
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        $comision = factory(Comision::class)->make([$campo => $valor]);
        $this->post('api/comision/',$comision->toArray())
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors($campo);
    }


    public function test_modificar_una_comision()
    {
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        $comision = factory(Comision::class)->create()->toArray();
        $comision['comisionNombre'] = 'Nombre Modificado';
        $this->put(sprintf('api/comision/%s', $comision['comisionId']), $comision)
            ->assertExactJson($comision)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @dataProvider test_validacion_de_los_request_para_crear_un_comision
     */
    public function test_validacion_request_al_modificar_una_comision(
        string $campo,
        $valor
    ){
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        $comision = factory(Comision::class)->create()->toArray();
        $comision[$campo] = $valor;
        $this->put(sprintf('api/comision/%s', $comision['comisionId']), $comision)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors($campo);
    }

    public function test_eliminar_una_comision()
    {
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        $comision = factory(Comision::class)->create()->toArray();
        $this->delete('api/comision', $comision)
            ->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertCount(0, Comision::all());
    }

    public function test_eliminar_una_comision_con_alumnos_inscriptos()
    {
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        $comision = factory(Comision::class)->create()->toArray();
        $estudiante = factory(Estudiante::class)->create()->toArray();
        factory(Matricula::class)->create([
            'estudianteId' => $estudiante['estudianteId'],
            'comisionId' => $comision['comisionId'],
            'matriculaSituacion' =>  'RE'
            ])->toArray();
        $this->delete('api/comision', $comision)
            ->assertStatus(Response::HTTP_FOUND);
        $this->assertCount(1, Comision::all());
    }

    public function test_eliminar_una_comision_que_no_existe()
    {
        $this->withoutMiddleware();
        factory(Curso::class)->create();
        $comisionNoExiste = factory(Comision::class)->make()->toArray();
        $this->delete('api/comision', $comisionNoExiste)
            ->assertStatus(Response::HTTP_FOUND);
    }


    /** afirmo que en la tabla estudiante se encuentra el email
     * $this->assertDatabaseHas('estudiantes', [
     *     'estudianteEmail' => $estudianteDatos['estudianteEmail'],
     *  ]);
     */

}
