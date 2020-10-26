<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Karyawan;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Karyawan::class, function (Faker $faker) {
    return [
        'nama' => $faker->name(null),
        'alamat' => $faker->address,
        'foto' => 'http://localhost:8000/images/user_image_dummy.png',
        'tanggal_bergabung' => Carbon::now(),
    ];
});
