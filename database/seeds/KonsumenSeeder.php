<?php

use App\Konsumen;
use App\User;
use Illuminate\Database\Seeder;

class KonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'konsumen')->get();

        foreach ($users as $u) {
            factory(Konsumen::class)->create([
                'user_id' => $u->id,
            ]);
        }
    }
}
