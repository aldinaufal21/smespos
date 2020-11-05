<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pengelola;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Pengelola::class, function (Faker $faker) {
    return [
        'nama_pengelola' => $faker->name,
        'login_terakhir' => Carbon::now(), 
    ];
});
