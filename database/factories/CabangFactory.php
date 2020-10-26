<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cabang;
use Faker\Generator as Faker;

$factory->define(Cabang::class, function (Faker $faker) {
    return [
        'nama_cabang' => $faker->company,
        'alamat_cabang' => $faker->address,
        'jumlah_karyawan' => $faker->numberBetween(10, 20),
        'gambar_karyawan' => 'http://localhost:8000/images/user_image_dummy.png',
    ];
});
