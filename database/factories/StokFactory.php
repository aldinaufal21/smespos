<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stok;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Stok::class, function (Faker $faker) {
    return [
        'stok' => 100,
        'tanggal_input' => Carbon::now(),
    ];
});
