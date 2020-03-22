<?php

use Illuminate\Http\Request;

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
        Route::get('logout', '    0@logout'); # Salgo
        Route::get('delete/user', 'AuthController@delete'); # elimino pero solo admin  VER LOS PERMISOS!!
    });
});

# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'estudiante'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'Estudiante\EstudianteController@index');
        Route::get('mostrar', 'Estudiante\EstudianteController@show');
        Route::post('crear', 'Estudiante\EstudianteController@store'); # Creo un estudiante
        Route::put('modificar/{estudiante}', 'Estudiante\EstudianteController@update'); # Modifico un estudiante
    });
});

# Group de ruta con prefijo matricula, agrego cors a las rutas
Route::group(['prefix' => 'matricula'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        # lo consumo desde reinscripcion de alumno..
        Route::post('crear','Matricula\MatriculaController@store');
        # consulta todas las matriculas (por apellido o dni)
        Route::get('mostrar','Matricula\MatriculaController@index');
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
        
        # devuelvo todas las comisiona ACTIVAS(que no se cerraron por la FFinal)
        Route::get('', 'Comision\ComisionController@index');
        Route::post('crear', 'Comision\ComisionController@store');
        Route::put('modificar/{comision}', 'Comision\ComisionController@update');
        Route::delete('eliminar/{comision}', 'Comision\ComisionController@destroy');
        Route::get('mostrar/{comision}', 'Comision\ComisionController@show');
    });
});


# Group de ruta con prefijo cursos/
Route::group(['prefix' => 'curso'], function () {
    # Ruta que solo acceda el usuario director..
    Route::group(['middleware' => ['auth:api','director']], function () {
        Route::get('', 'Curso\CursoController@index');
        // Route::post('crear', 'Curso\CursoController@store');
    });
});
