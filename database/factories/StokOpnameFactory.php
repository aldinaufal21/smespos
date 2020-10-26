<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StokOpname;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(StokOpname::class, function (Faker $faker) {
    return [
        'jumlah' => 100,
        'harga' => $faker->numberBetween(10000,200000),
        'tanggal_stok_opname' => Carbon::now(),
    ];
});
