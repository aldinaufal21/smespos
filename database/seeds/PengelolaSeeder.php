<?php

use App\Pengelola;
use App\User;
use Illuminate\Database\Seeder;

class PengelolaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'pengelola')->get();

        foreach ($users as $u) {
            factory(Pengelola::class)->create([
                'user_id' => $u->id,
            ]);
        }
    }
}
