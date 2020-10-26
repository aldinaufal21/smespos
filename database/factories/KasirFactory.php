<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Kasir;
use Faker\Generator as Faker;

$factory->define(Kasir::class, function (Faker $faker) {
    return [
        'nama_kasir' => $faker->name(null),
    ];
});
