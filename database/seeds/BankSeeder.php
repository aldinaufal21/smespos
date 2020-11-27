<?php

use App\Bank;
use App\Umkm;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            "BANK BRI", 
            "BANK BNI", 
            "BANK MANDIRI"
        ];
        
        $umkm = Umkm::all();

        foreach ($umkm as $um) {
            foreach ($banks as $bank) {
                factory(Bank::class)->create([
                    'nama_bank' => $bank,
                    'umkm_id' => $um->umkm_id,
                ]);
            }
        }
    }
}
