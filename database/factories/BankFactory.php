<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bank;
use Faker\Generator as Faker;

$factory->define(Bank::class, function (Faker $faker) {
    return [
        'rekening' => $faker->bankAccountNumber,
        'atas_nama' => $faker->name(null),
    ];
});
