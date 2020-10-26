<?php

use App\KategoriProduk;
use App\Umkm;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $umkm = Umkm::all();

        foreach ($umkm as $u) {
            factory(KategoriProduk::class, 3)->create([
                'umkm_id' => $u->umkm_id,
            ]);
        }
    }
}
