<?php

namespace Tests\Feature;

use App\User;
use App\Comision;
use App\Curso;
use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlumnosModulTest extends TestCase
{
    use RefreshDatabase; # para actualiza la base con la base_test(realiza las migraciones)
    /**
     * A basic feature test example.
     * @test
     */
    public function Alumno_Inscripcion()
    {
        $this->withoutExceptionHandling();

        $role = new Role(
            [
            'roleId'=>1,
            'roleDescripcion' => 'director'
            ]
        );
        $role->save();
        $user = factory(User::class)->create([
            'userNombre'        => 'ale',
            'email'             => 'ale@gmail.com',
            'email_verified_at' => now(),
            'userImagen'        => '',
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => '123',
            'roleId'            => 1,
        ]);

        Curso::create([
            'cursoNombre' => 'SJCC',
            'cursoNroCuota' => 12,
            'cursoCostoMes' => 850,
            'cursoInscripcion' => 1350,
        ]);

        Comision::create([
            'comisionNombre'=>'comision_test',
            'comisionHorario'=>'LUN,MAR,MIER',
            'comisionFI'=> '2019-1-1', //date('Y-m-d','now') ,
            'comisionFF'=>'2020-1-1',  //dateTimeThisYear('now', null) ,
            'cursoId'=> 1 ,
        ]);
        
        $this->get('/alumnos/inscripcion')
            ->actingAs('api')
            ->assertStatus(200)
            ->assertSee('comision_test');
    }
}
