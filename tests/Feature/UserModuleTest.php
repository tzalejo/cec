<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\Passport;
class UserModuleTest extends TestCase
{
    use RefreshDatabase; # para actualiza la base con la base_test(realiza las migraciones)

    public function test_autenticacion_de_un_usuario()
    {
        /**
         * Sin llamada Artisan obtendrá un pasaporte
         * error: 'Personal access client not found. Please create one.'
         */
        Artisan::call('passport:install');
        factory(Role::class)->create();
        $user = factory(User::class)->create()->toArray();
        // dd($user);
        $credentials = [
            'email' => $user['email'],
            'password' => 'secret',
        ];
        $this->post('api/auth/login', $credentials)
            ->assertJsonStructure([
                'userNombre' ,
                'email'      ,
                'userImagen' ,
                'roleId'     ,
                'token'      ,
                'token_type' ,
                'expires_at' ,
            ])
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_no_autenticacion_del_usuario_con_credenciales_invalidas()
    {
        $credentials = [
            'email' => 'correo_no_registrado@email.com',
            'password' => 'secret',
        ];
        $this->post('api/auth/login', $credentials)
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_validacion_request_de_autenticacion()
    {
        $this->assertTrue(true);
        return [
            'El mail es requerido para la autenticacion' => ['email', null],
            'No es un mail valido' => ['email', 'email_no_valido'],
            'El password es requerido para la autenticacion' => ['password', null],
        ];
    }

    /**
     * @dataProvider test_validacion_request_de_autenticacion
     */
    public function test_valida_los_datos_de_autenticacion($campo,$valor)
    {
        $credentials = [
            'email' =>  'test@email.com',
            'password' => 'test',
        ];
        $credentials[$campo] = $valor;
        $this->post('api/auth/login', $credentials)
            ->assertSessionHasErrors($campo)
            ->assertStatus(Response::HTTP_FOUND);
    }

    public function test_valida_registro_de_un_usuario()
    {
        // $this->withoutMiddleware();
        // $this->withoutExceptionHandling();
        factory(Role::class)->create();
        $user = [
            'userNombre' => 'eliseo nicolas',
            'email' => 'myriam.crona@example.net',
            'password' => 'secret',
            'userImagen' => '',
            'roleId' => 1,
        ];
        $this->post('api/auth/signup', $user)
            ->assertJsonStructure(['message'])
            ->assertExactJson(['message' => 'Usuario Eliseo Nicolas creado satisfactoriamente'])
            ->assertStatus(Response::HTTP_CREATED);
        $this->assertCount(1, User::all());
    }


    public function test_valida_request_registro()
    {
        $this->assertTrue(true);
        return [
            'El Nombre del Usuario es requerido para la autenticacion' => ['userNombre', null],
            'El mail es requerido para la autenticacion' => ['email', null],
            'El password es requerido para la autenticacion' => ['password', null],
            'No es un mail valido' => ['email', 'email_no_valido']
        ];
    }


    /**
     * @dataProvider test_valida_request_registro
     */
    public function test_valida_los_datos_del_registro_de_un_usuario($campo, $valor)
    {
        factory(Role::class)->create();
        $user = [
            'userNombre' => 'eliseo nicolas',
            'email' => 'myriam.crona@example.net',
            'password' => 'secret',
            'userImagen' => 'test/test.png',
            'roleId' => 1,
        ];
        $user[$campo]= $valor;
        // dd($user);
        $this->post('api/auth/signup', $user)
            ->assertSessionHasErrors($campo)
            ->assertStatus(Response::HTTP_FOUND);
        // $this->assertCount(1, User::all());
    }

    public function test_registro_de_un_usuario_con_un_mail_ya_registrado()
    {
        factory(Role::class)->create();
        $user = factory(User::class)->create()->toArray();
        // dd($user);
        $this->post('api/auth/signup', $user)
            ->assertSessionHasErrors(['email'])
            ->assertStatus(Response::HTTP_FOUND);
        $this->assertCount(1, User::all());
    }

    

}
