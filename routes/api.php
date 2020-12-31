<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Estudiante\EstudianteController;
use App\Http\Controllers\Matricula\MatriculaController;
use App\Http\Controllers\Cuota\CuotaController;
use App\Http\Controllers\Comision\ComisionController;
use App\Http\Controllers\Curso\CursoController;
use App\Http\Controllers\Materia\MateriaController;
use App\Http\Controllers\Pago\PagoController;

# Para manejo de credenciales de los usuarios, agrego cors a las rutas
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']); # Me Logueo
    Route::post('signup', [AuthController::class, 'signup']); # Creo un usuario(Users)
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', [AuthController::class, 'logout']); # Salgo
        Route::get('deletes/users', [AuthController::class, 'delete']); # elimino pero solo admin  VER LOS PERMISOS!!
    });
});

# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'estudiantes'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', [EstudianteController::class, 'index']);
        // Route::get('', 'Estudiante\EstudianteController@show');
        Route::post('', [EstudianteController::class, 'store']);
        # Actualizo foto, lo dejo como post porque me genera error put
        Route::post('/{estudiante}', [
            EstudianteController::class,
            'updateEstudianteFoto',
        ]);
        Route::put('/{estudiante}', [EstudianteController::class, 'update']); # Modifico un estudiante
    });
});

# Group de ruta con prefijo matricula, agrego cors a las rutas
Route::group(['prefix' => 'matriculas'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        # lo consumo desde reinscripcion de alumno..
        Route::post('', [MatriculaController::class, 'store']);
        # consulta todas las matriculas (por apellido o dni)
        # Route::get('mostrar','Matricula\MatriculaController@index');
        # modifico matricula
        Route::put('{matricula}', [MatriculaController::class, 'update']);
    });
});

# Group de ruta con prefijo cuota, agrego cors a las rutas
Route::group(['prefix' => 'cuotas'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        # devolvemos matricua->cuotas->pagos
        Route::get('{matricula}', [CuotaController::class, 'index']);
        # para realizar un pago de un cuota..
        Route::post('', [CuotaController::class, 'store']);
    });
});

#Para manejo de comsiones
Route::group(['prefix' => 'comisiones'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        # devuelvo todas las comisiones INACTIVAS fdesde fhasta
        Route::get('/{fechaDesde}/{fechaHasta}/inactivas', [
            ComisionController::class,
            'indexComisionesInactivas',
        ]);
        Route::get('/{comision}', [ComisionController::class, 'show']);
        # devuelvo todas las comisiones ACTIVAS
        Route::get('/', [ComisionController::class, 'index']);
        Route::post('', [ComisionController::class, 'store']);
        Route::put('/{comision}', [ComisionController::class, 'update']);
        Route::delete('', [ComisionController::class, 'destroy']);
    });
});

# Group de ruta con prefijo cursos/
Route::group(['prefix' => 'cursos'], function () {
    # Ruta que solo acceda el usuario director..
    Route::group(['middleware' => ['auth:api', 'director']], function () {
        Route::get('/{curso}', [CursoController::class, 'show']);
        Route::get('', [CursoController::class, 'index']);
        Route::put('/{curso}', [CursoController::class, 'update']);
        Route::delete('/{curso}', [CursoController::class, 'destroy']);
        Route::delete('/{curso}/{materia}', [
            CursoController::class,
            'destroyCursoMateria',
        ]);
        Route::post('', [CursoController::class, 'store']);
        Route::post('/materias', [CursoController::class, 'storeCursoMateria']);
    });
});
# Group de ruta con prefijo cursos/
Route::group(['prefix' => 'materias'], function () {
    # Ruta que solo acceda el usuario director..
    Route::group(['middleware' => ['auth:api', 'director']], function () {
        Route::get('', [MateriaController::class, 'index']);
        Route::get('diff/{curso}', [
            MateriaController::class,
            'indexMateriasDiff',
        ]);
        Route::get('cursos/{curso}', [MateriaController::class, 'show']); // todas las materias del curso
        Route::post('', [MateriaController::class, 'store']);
        Route::delete('/{materia}', [MateriaController::class, 'destroy']);
        Route::put('/{materia}', [MateriaController::class, 'update']);
    });
});

# Grupo de ruta con prefijo pago
Route::group(['prefix' => 'pagos'], function () {
    // Route::group(['middleware' => ['auth:api','director']], function () {
    Route::post('', [PagoController::class, '@store']);
    // });
});
