<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')
        ->name('home');

// vamos a manejar inscripcion(abm) y legajo
Route::get('/alumnos/inscripcion','AlumnosController@inscripcion')
        ->name('alumnos.inscripcion'); // con esto podemos nombrando a la ruta y podesmo usar ese nombre para referirnos a ella route('alumno.inscripcion')
        // ->name('alumnos.inscripcion',['id'=> 'mis_valor']) asi enviamos un valor 
Route::post('/alumnos/crear','AlumnosController@store')
        ->name('alumnos.crear');


