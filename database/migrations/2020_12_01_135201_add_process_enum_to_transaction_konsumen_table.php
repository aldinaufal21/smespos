<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcessEnumToTransactionKonsumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE transaksi_konsumens 
                        MODIFY `status` enum('belum_bayar','menunggu_verifikasi','terverifikasi','diantar','siap diambil','selesai','dibatalkan')
                        NOT NULL
                        DEFAULT 'belum_bayar';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        DB::statement("ALTER TABLE transaksi_konsumens 
                        MODIFY `status` enum('belum_bayar','menunggu_verifikasi','diantar','siap diambil','selesai','dibatalkan')
                        NOT NULL
                        DEFAULT 'belum_bayar';");
    }
}
