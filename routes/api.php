<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# envio a la home del sistema
// Route::middleware('auth:api')->get('home','HomeController@index');

# Para manejo de credenciales de los usuarios, agrego cors a las rutas
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login'); # Me Logueo
    Route::post('signup', 'AuthController@signup'); # Creo un usuario(Users)
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', '    AuthController@logout'); # Salgo
        Route::get('delete/user', 'AuthController@delete'); # elimino pero solo admin  VER LOS PERMISOS!!
    });
});

# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'estudiante'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'Estudiante\EstudianteController@index');
        // Route::get('', 'Estudiante\EstudianteController@show');
        Route::post('', 'Estudiante\EstudianteController@store');
        # Actualizo foto, lo dejo como post porque me genera error put
        Route::post('/{estudiante}', 'Estudiante\EstudianteController@updateEstudianteFoto');
        Route::put('/{estudiante}', 'Estudiante\EstudianteController@update'); # Modifico un estudiante
    });
});

# Group de ruta con prefijo matricula, agrego cors a las rutas
Route::group(['prefix' => 'matricula'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        # lo consumo desde reinscripcion de alumno..
        Route::post('','Matricula\MatriculaController@store');
        # consulta todas las matriculas (por apellido o dni)
        # Route::get('mostrar','Matricula\MatriculaController@index');
        # modifico matricula
        Route::put('{matricula}','Matricula\MatriculaController@update');
    });
});

# Group de ruta con prefijo cuota, agrego cors a las rutas
Route::group(['prefix' => 'cuota'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {

        # devolvemos matricua->cuotas->pagos
        Route::get('{matricula}', 'Cuota\CuotaController@index');
        # para realizar un pago de un cuota..
        Route::post('', 'Cuota\CuotaController@store');
    });
});


#Para manejo de comsiones
Route::group(['prefix' => 'comision'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        # devuelvo todas las comisiones INACTIVAS fdesde fhasta
        Route::get('/{fechaDesde}/{fechaHasta}/', 'Comision\ComisionController@indexComisionesInactivas');
        Route::get('/{comisionId}', 'Comision\ComisionController@show');
        # devuelvo todas las comisiones ACTIVAS
        Route::get('/', 'Comision\ComisionController@index');
        Route::post('', 'Comision\ComisionController@store');
        Route::put('/{comision}', 'Comision\ComisionController@update');
        Route::delete('', 'Comision\ComisionController@destroy');
    });
});


# Group de ruta con prefijo cursos/
Route::group(['prefix' => 'curso'], function () {
    # Ruta que solo acceda el usuario director..
    Route::group(['middleware' => ['auth:api','director']], function () {
        Route::get('/{curso}', 'Curso\CursoController@show');
        Route::get('', 'Curso\CursoController@index');
        Route::put('/{curso}', 'Curso\CursoController@update');
        Route::put('/{curso}/{materia}', 'Curso\CursoController@updateCursoMateria');
        Route::delete('/{curso}', 'Curso\CursoController@destroy');
        Route::delete('/{curso}/{materia}', 'Curso\CursoController@destroyCursoMateria');
        Route::post('','Curso\CursoController@store');
    });
});
# Group de ruta con prefijo cursos/
Route::group(['prefix' => 'materia'], function () {
    # Ruta que solo acceda el usuario director..
    Route::group(['middleware' => ['auth:api','director']], function () {
        Route::get('', 'Materia\MateriaController@index');
        Route::get('/{curso}', 'Materia\MateriaController@indexMateriasDiff');
        // Route::get('/{curso}', 'Materia\MateriaController@show');
        Route::post('', 'Materia\MateriaController@store');
        Route::delete('/{materia}', 'Materia\MateriaController@destroy');
        Route::put('/{materia}', 'Materia\MateriaController@update');
    });
});

# Grupo de ruta con prefijo pago
Route::group(['prefix' => 'pago'], function () {
    // Route::group(['middleware' => ['auth:api','director']], function () {
        Route::post('','Pago\PagoController@store');
    // });
});
