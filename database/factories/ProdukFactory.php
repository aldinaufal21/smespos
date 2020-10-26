<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produk;
use App\StokOpname;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Produk::class, function (Faker $faker) {
    return [
        'nama_produk' => $faker->firstName(null),
        'gambar_produk' => 'http://localhost:8000/images/image_dummy.png',
        'deskripsi_produk' => $faker->realText(100, 2),
        'stok' => 100,
        'tanggal_input' => Carbon::now(),
    ];
});

$factory->afterCreating(Produk::class, function ($produk, $faker) {
    $produk->save(factory(StokOpname::class)->create([
        'produk_id' => $produk->produk_id
    ])->toArray());
});
