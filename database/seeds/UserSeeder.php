<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create([
            'role' => 'konsumen',
        ]);
        
        factory(App\User::class, 5)->create([
            'role' => 'umkm',
        ]);

        factory(App\User::class, 5)->create([
            'role' => 'pengelola',
        ]);
    }
}
