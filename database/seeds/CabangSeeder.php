<?php

use App\Cabang;
use App\Umkm;
use App\User;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $umkm = Umkm::all();

        foreach ($umkm as $um) {
            $user = factory(User::class)->create([
                'role' => 'cabang',
            ]);

            factory(Cabang::class)->create([
                'umkm_id' => $um->umkm_id,
                'user_id' => $user->id,
            ]);
        }
    }
}
