<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comision;
use App\Estudiante;
use App\Matricula;
use Faker\Generator as Faker;

$factory->define(Matricula::class, function (Faker $faker) {
    return [
        'matriculaSituacion' => 'RE',
        'estudianteId' => function () {
            return Estudiante::query()->inRandomOrder()->first()->estudianteId;
        },
        'comisionId' => function () {
            return Comision::query()->inRandomOrder()->first()->comisionId;
        },
    ];
});
