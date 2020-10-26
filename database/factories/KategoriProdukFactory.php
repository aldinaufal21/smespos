<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\KategoriProduk;
use App\Produk;
use Faker\Generator as Faker;

$factory->define(KategoriProduk::class, function (Faker $faker) {
    return [
        'nama_kategori' => 'Kategori ' . $faker->numberBetween(1, 10000),
    ];
});

$factory->afterCreating(KategoriProduk::class, function ($kategoriProduk, $faker) {
    $kategoriProduk->save(factory(Produk::class, 10)->create([
        'kategori_produk_id' => $kategoriProduk->kategori_produk_id
    ])->toArray());
});
