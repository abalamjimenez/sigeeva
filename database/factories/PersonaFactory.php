<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Persona;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Persona::class, function (Faker $faker) {
    return [
        'uuid'                  => Uuid::uuid4()->toString(),
        'nombre'                => $faker->firstName,
        'primer_apellido'       => $faker->lastName,
        'segundo_apellido'      => $faker->lastName,
        'sexo'                  => $faker->randomElement(array( 'H', 'M' )),
        'tipo_registro'         => 'ALUMNO',
        'telefono'              => $faker->numerify('98383#####'),
        'fecha_nacimiento'      =>  $faker->dateTimeThisCentury->format('Y-m-d'),
        'curp'                  => $faker->numerify('##################'),
        'email'                 => $faker->unique()->safeEmail,
        'entidad_nacimiento_id' => 23,
        'pais_nacimiento_id'    => 146,
    ];
});
