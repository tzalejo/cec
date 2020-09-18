<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Curso;
use Faker\Generator as Faker;

$factory->define(Curso::class, function (Faker $faker) {
    return [
        'cursoNombre' => $faker->numerify('Curso ##'),
        'cursoNroCuota' => $faker->numberBetween(4 ,12),
        'cursoCostoMes' => $faker->numberBetween(5000 ,7000),
        'cursoInscripcion' => $faker->numberBetween(5000 ,7000),
    ];
});
