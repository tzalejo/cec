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
Route::middleware('auth:api')->get('home','HomeController@index');

# Para manejo de credenciales de los usuarios
Route::group(['prefix' => 'auth'], function () {
    Route::post('login',  'AuthController@login'); # Me Logueo
    Route::post('signup', 'AuthController@signup'); # Creo un usuario(Users)
    
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user',   'AuthController@user');
        
    });
});

# Group de ruta con prefijo alumnos
Route::group(['prefix' => 'alumnos'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('inscripcion', 'AlumnosController@inscripcion');
        Route::post('crear' ,'AlumnosController@store');
        Route::get('mostrar','AlumnosController@show');
        # Route::get('cuotas' ,'AlumnosController@cuotas');

    });
});

# Group de ruta con prefijo cursos/
Route::group(['prefix' => 'cursos'], function () {
    # Ruta que solo acceda el usuario director..
    Route::group(['middleware' => ['auth:api','director']], function () {
        Route::get('crear', 'CursoController@create');
    });
    
});


