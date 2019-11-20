<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Estudiante;
use Faker\Generator as Faker;

$factory->define(Estudiante::class, function (Faker $faker) {
    return [
        'estudianteDNI'         => $faker->randomNumber(8, false),
        'estudianteApellido'    => $faker->lastName,
        'estudianteNombre'      => $faker->firstNameMale,
        'estudianteDomicilio'   => $faker->secondaryAddress,
        'estudianteTelefono'    => $faker->tollFreePhoneNumber,
        'estudianteLocalidad'   => $faker->country,
        'estudianteEmail'       => $faker->email,
        'estudianteNacimiento'  => $faker->date('Y-m-d', 'now'),
        'estudianteFoto'        => $faker->mimeType,
    ];
});
