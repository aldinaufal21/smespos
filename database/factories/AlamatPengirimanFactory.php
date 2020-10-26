<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AlamatPengiriman;
use Faker\Generator as Faker;

$factory->define(AlamatPengiriman::class, function (Faker $faker) {
    return [
        'alamat' => $faker->address,
    ];
});
