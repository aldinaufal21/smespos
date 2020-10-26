<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AlamatPengiriman;
use App\Konsumen;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Konsumen::class, function (Faker $faker) {
    return [
        'nama_konsumen' => $faker->name,
        'alamat_konsumen' => $faker->address,
        'nomor_hp' => $faker->e164PhoneNumber,
        'gambar' => 'http://localhost:8000/images/user_image_dummy.png',
        'tanggal_gabung' => Carbon::now(),
        'login_terakhir' => Carbon::now('0000', '00', '00', '00'),
    ];
});


$factory->afterCreating(Konsumen::class, function ($konsumen, $faker) {
    $konsumen->save(factory(AlamatPengiriman::class)->create([
        'konsumen_id' => $konsumen->konsumen_id
    ])->toArray());
});
