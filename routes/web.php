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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')
//         ->name('home');

// # vamos a manejar inscripcion(abm) y legajo
// Route::get('/alumnos/inscripcion','AlumnosController@inscripcion')
//         ->name('alumnos.inscripcion'); // con esto podemos nombrando a la ruta y podesmo usar ese nombre para referirnos a ella route('alumno.inscripcion')
//         // ->name('alumnos.inscripcion',['id'=> 'mis_valor']) asi enviamos un valor
// Route::post('/alumnos/crear','AlumnosController@store')
//         ->name('alumnos.crear');

// # listado de estudiantes para hacer el pago de cuota o inscripcion..
// Route::get('/alumnos/mostrar','AlumnosController@show')
//         ->name('alumnos.mostrar');

// # pantalla de la matricula con los pagos
// Route::get('/alumnos/{matricula}/cuotas','AlumnosController@cuotas')
//         ->name('alumnos.cuotas');

// # obtenemos los datos del alumnos para luego editarlos.
// Route::get('/alumnos/{matricula}/editar','AlumnosController@edit')
//         ->name('alumnos.editar');





// # actualizamos los datos del alumno.
// Route::put('/alumnos/{estudiante}','AlumnosController@update')
//         ->name('alumnos.actualizar');
// # eliminamo el alumno
// Route::delete('/alumnos/{matricula}','AlumnosController@destroy')
//         ->name('alumnos.eliminar');

        

// # hacemos el pago de la cuota seleccionada.
// Route::get('/alumnos/{cuota}/pago','AlumnosController@pago')
//         ->name('alumnos.pago');

// # falta esta opcion..
// Route::post('/alumnos/{cuota}/pago','AlumnosController@cancelarPago')
//         ->name('alumnos.cancelarPago');

// # para los alumnos q ya se inscribieron
// Route::get('/alumnos/reinscripcion','AlumnosController@reinscripcion')
//         ->name('alumnos.reinscripcion');

// # vamos a manejar inscripcion(abm) y legajo
// Route::get('/alumnos/{estudiante}/inscripcion','AlumnosController@reinscripcionEstudiante')
//         ->name('alumnos.reinscripcionEstudiante');

// Route::post('/alumnos/{estudiante}/inscripcion','AlumnosController@altaReinscripcionEstudiante')
//         ->name('alumnos.altaReinscripcionEstudiante');


// ### ****** rutas del gerente ********* ###

// # pantalla inicio para crear un curso
// Route::group(['middleware' => 'director'], function () {
        
//         Route::get('/curso/crear','CursoController@create')
//                 ->name('curso.crear');
                
//         Route::post('/curso/crear', 'CursoController@store')
//                 ->name('curso.guardar');
        
                
//         # crear una materia
//         Route::get('/materia/crear','MateriaController@create')
//                 ->name('materia.crear');

//         Route::post('/materia/crear', 'MateriaController@store')
//                 ->name('materia.guardar');
//         # eliminamo el alumno
//         Route::delete('/materia/{materia}','MateriaController@destroy')
//                 ->name('materia.eliminar');

//         #editar materia
        

// });
