<?php
namespace Tests\Feature;

use App\User;
use App\Estudiante;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;

class EstudianteModulTest extends TestCase
{
    use RefreshDatabase; # para actualiza la base con la base_test(realiza las migraciones)

    public function testLogin()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['estudiante']
        );
        $this->get('/api/estudiante')
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_inscripcion_alumno()
    {
        $this->withoutMiddleware();
        $estudianteDatos = [
            'estudianteId' => 1,
            'estudianteDNI' => 25934961,
            'estudianteApellido' => 'Goyette',
            'estudianteNombre' => 'Lloyd',
            'estudianteDomicilio' => 'Apt. 189',
            'estudianteTelefono' => '1-888-385-9415',
            'estudianteLocalidad' => 'Cote Divoire',
            'estudianteEmail' => 'hcartwright@hotmail.com',
            'estudianteNacimiento' => '2005-06-22',
            'estudianteFoto' => 'application/vnd.wap.wbxml'
        ];

        $this->post('api/estudiante/', $estudianteDatos )
            ->assertOk()
            ->assertStatus(Response::HTTP_OK);

        $estudiante = Estudiante::first();
        $this->assertCount(1, Estudiante::all());
        $this->assertEquals($estudiante->toArray(), $estudianteDatos);
    }

    public function test_Obtener_Estudiante_Filtrando_Por_Dni_Apellido()
    {
        $this->withoutMiddleware();

        $estudiante = factory(Estudiante::class, 3)->create();
        $estudiante[0]['matriculas'] = [];
        $this->call('GET', '/api/estudiante',[
            'dni' =>$estudiante[0]['estudianteDNI'],
            'apellido' => $estudiante[0]['estudianteApellido']
        ])
            ->assertExactJson([$estudiante[0]->toArray()])
            ->assertOk()
            ->assertStatus(Response::HTTP_OK);

    }

    public function test_Error_Al_filtar_por_dni_enviando_un_string()
    {
        // $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        factory(Estudiante::class, 3)->create();
        $this->json('GET', '/api/estudiante',[
            'dni' => '1dds',
            'apellido' => 'Valenzuela'
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    public function test_Obtner_Estudiante_filtrando_Por_Dni_Y_Apellido_Igual_A_Null()
    {
        $this->withoutMiddleware();

        factory(Estudiante::class, 3)->create();
        $this->call('GET', '/api/estudiante')
            ->assertJsonCount(3)
            ->assertOk()
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_Modificar_Datos_Del_Estudiante()
    {
        $this->withoutMiddleware();
        $estudiante = factory(Estudiante::class)->create()->toArray();
        $estudianteModificado = Estudiante::findOrFail($estudiante['estudianteId'])->toArray();
        $estudianteModificado['estudianteNombre'] = 'Modificado';
        // dd($estudianteModificado);
        $response = $this->put(sprintf('api/estudiante/%s', $estudiante['estudianteId']),$estudianteModificado);
        $response
            ->assertExactJson($estudianteModificado)
            ->assertStatus(Response::HTTP_OK);
    }


    public function test_crear_estudiante_con_dni_unico()
    {
        $this->withoutMiddleware();
        $response = factory(Estudiante::class)->create()->toArray();
        $estudiante = [
            'estudianteDNI' => "46484889498",
            'estudianteApellido' => 'Goyette',
            'estudianteNombre' => 'Lloyd',
            'estudianteDomicilio' => 'Apt. 189',
            'estudianteTelefono' => '1-888-385-9415',
            'estudianteLocalidad' => 'Cote Divoire',
            'estudianteEmail' => 'hcartwright@hotmail.com',
            'estudianteNacimiento' => '2005-06-22',
            'estudianteFoto' => 'application/vnd.wap.wbxml'];

        $estudiante['estudianteDNI'] = $response['estudianteDNI'];

        $this->post('api/estudiante/', $estudiante)
            ->assertStatus(Response::HTTP_FOUND);
    }

    public function test_crear_estudiante_con_email_unico()
    {
        $this->withoutMiddleware();
        $response = factory(Estudiante::class)->create()->toArray();
        $this->post('api/estudiante/',[
            'estudianteDNI' => 123456789,
            'estudianteApellido' => 'Goyette',
            'estudianteNombre' => 'Lloyd',
            'estudianteDomicilio' => 'Apt. 189',
            'estudianteTelefono' => '1-888-385-9415',
            'estudianteLocalidad' => 'Cote Divoire',
            'estudianteEmail' => intval($response['estudianteEmail']),
            'estudianteNacimiento' => '2005-06-22',
            'estudianteFoto' => 'application/vnd.wap.wbxml',
            'estudianteId' => 1]
        )->assertStatus(Response::HTTP_FOUND);

    }
    /**
     * @test que valida todo los valores de store Estudiantes
     */

    public function test_validacion_de_los_request_para_crear_un_estudiante()
    {
        $this->assertTrue(true);
        return [
            'Requiere el campo Nombre ' => ['estudianteNombre', null],
            'El campo Nombre tiene como maximo 50 caracteres' => ['estudianteNombre', 'El campo Nombre requiere como maximo 50 caracteres '],
            'El campo Nombre requiere como minimo 3 caracteres' => ['estudianteNombre', 'ab'],
            'Requiere el campo DNI ' => ['estudianteDNI', null],
            'Requiere el campo Domicilio ' => ['estudianteDomicilio', null],
            'Requiere el campo Email ' => ['estudianteEmail', null],
            'Requiere el campo Email solo acepta email' => ['estudianteEmail', 'No es un email'],
            'Requiere el campo Localidad ' => ['estudianteLocalidad', null],
            'Requiere el campo Nacimiento ' => ['estudianteNacimiento', null],
            'Requiere el campo Apellido ' => ['estudianteApellido', null],
            'El campo Apellido tiene como maximo 50 caracteres' => ['estudianteApellido', 'El campo estudianteApellido requiere como maximo 50 caracteres '],
            'El campo Apellido requiere como minimo 3 caracteres' => ['estudianteApellido', 'ab'],
        ];
    }

    /**
     * @dataProvider test_validacion_de_los_request_para_crear_un_estudiante
     */
    public function test_validacion_request(
        string $campo,
        $valor
    ){
        $this->withoutMiddleware();
        $estudiante = factory(Estudiante::class)->make([$campo => $valor]);
        $this->post('api/estudiante/',$estudiante->toArray())
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors($campo);
    }
}
