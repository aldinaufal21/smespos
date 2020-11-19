<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PendaftaranUmkm;
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

$factory->afterCreating(Umkm::class, function ($umkm, $faker) {
    $umkm->save(factory(PendaftaranUmkm::class)->create([
        'status_pendaftaran' => 'pending',
        'no_ktp' => $faker->randomNumber(20),
        'pengelola_id' => null,
        'tanggal_pendaftaran' => Carbon::now(),
        'umkm_id' => $umkm->umkm_id
    ])->toArray());
});
