<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PendaftaranUmkm;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(PendaftaranUmkm::class, function (Faker $faker) {
    return [
        'status_pendaftaran' => 'pending',
        'no_ktp' => $faker->randomNumber(5),
        'pengelola_id' => null,
        'tanggal_pendaftaran' => Carbon::now(),
    ];
});
