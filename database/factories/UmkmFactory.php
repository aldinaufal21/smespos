<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Umkm;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Umkm::class, function (Faker $faker) {
    return [
        'nama_umkm' => $faker->company . $faker->companySuffix, 
        'deskripsi' => $faker->realText(100, 2), 
        'alamat_umkm' => $faker->address, 
        'gambar' => 'http://localhost:8000/images/image_dummy.png', 
        'tanggal_bergabung' => Carbon::now(), 
    ];
});
