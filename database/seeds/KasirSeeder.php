<?php

use App\Cabang;
use App\Kasir;
use Illuminate\Database\Seeder;

class KasirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cabang = Cabang::all();

        foreach ($cabang as $c) {
            factory(Kasir::class, 3)->create([
                'cabang_id' => $c->cabang_id,
            ]);
        }
    }
}
