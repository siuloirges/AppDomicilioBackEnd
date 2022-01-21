<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'tipo_documento' => $faker->randomDigit,
        'numero_documento' => $faker->randomNumber(9),
        'telefono' => $faker->randomNumber(7),
        'email' => $faker->unique()->email,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'tipo_vehiculo' =>$faker->company,
        'placa_vehiculo' =>$faker->creditCardType,
        'foto_documento_identidad_1' =>$faker->imageUrl(300 ,300),
        'foto_documento_identidad_2' =>$faker->imageUrl(300 ,300),
        'foto_targeta_propiedad_1' =>$faker->imageUrl(300 ,300),
        'foto_targeta_propiedad_2' =>$faker->imageUrl(300 ,300),
        'foto_soat_1' =>$faker->imageUrl(300 ,300),
        'foto_soat_2' =>$faker->imageUrl(300 ,300),
        'foto_vehiculo_1' =>$faker->imageUrl(300 ,300),
        'foto_vehiculo_2' =>$faker->imageUrl(300 ,300),
        'rol_id' => $faker->randomDigit,
        'id_aliado' => $faker->randomDigit,
        'remember_token'=>Str::random(10),
    ];
});
