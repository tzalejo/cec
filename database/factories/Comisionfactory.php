<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comision;
use App\Curso;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Comision::class, function (Faker $faker) {
    $curso = Curso::query()->inRandomOrder()->first();
    $date = Carbon::now();
    $fechaInicio = $date->format('Y-m-d');
    $fechafin = $date->addMonths($curso->cursoNroCuota)->format('Y-m-d');

    return [
        'comisionNombre' => $faker->numerify('Comision ##'),
        'comisionHorario' => "$faker->dayOfWeek" ." $faker->time",
        'comisionFI' => $fechaInicio,
        'comisionFF'=> $fechafin,
        'cursoId'=> $curso->cursoId,
    ];
});
