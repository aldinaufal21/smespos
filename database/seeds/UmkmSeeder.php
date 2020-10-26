<?php

use App\Umkm;
use App\User;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'umkm')->get();

        foreach ($users as $u) {
            factory(Umkm::class)->create([
                'user_id' => $u->id,
            ]);
        }
    }
}
