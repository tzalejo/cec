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
Route::group(['prefix' => 'auth','middleware' => 'cors'], function () {
    Route::post('login',  'AuthController@login'); # Me Logueo
    Route::post('signup', 'AuthController@signup'); # Creo un usuario(Users)
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout'); # Salgo
    });
});

# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'alumnos','middleware' => 'cors'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        
        Route::get('mostrar','Estudiante\EstudianteController@show');
        Route::post('crear' ,'Estudiante\EstudianteController@store'); # Creo un estudiante
        Route::put('modificar/{estudiante}' ,'Estudiante\EstudianteController@update'); # Modifico un estudiante
        
        # para realizar un pago de un cuota..
        Route::put('cuota/{cuota}' ,'Cuota\CuotaController@update');
        
        # devuelvo todas las comisiona ACTIVAS(que no se cerraron por la FFinal)
        Route::get('comision', 'Comision\ComisionController@index');


    });
});

# Group de ruta con prefijo cursos/
Route::group(['prefix' => 'cursos'], function () {
    # Ruta que solo acceda el usuario director..
    Route::group(['middleware' => ['auth:api','director']], function () {
        // Route::get('crear', 'CursoController@create');
    });
});


