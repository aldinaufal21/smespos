<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(UmkmSeeder::class);
        $this->call(KonsumenSeeder::class);
        $this->call(KaryawanSeeder::class);
        $this->call(CabangSeeder::class);
        $this->call(KasirSeeder::class);
        $this->call(ProdukSeeder::class);
    }
}
