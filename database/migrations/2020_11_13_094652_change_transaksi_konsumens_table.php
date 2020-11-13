<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTransaksiKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_konsumens', function (Blueprint $table) {
            $table->bigInteger('total_biaya');
            $table->enum('jenis_order', ['take_away', 'delivery'])->default('take_away');
            $table->enum('status', ['belum_bayar', 'menunggu_verifikasi', 'diantar', 'siap diambil', 'selesai', 'dibatalkan'])->default('belum_bayar');
            $table->string('bukti_transfer');
            $table->string('catatan_order');
            $table->bigInteger('alamat_pengiriman_id')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->foreign('alamat_pengiriman_id')->references('alamat_pengiriman_id')->on('alamat_pengiriman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_konsumens', function (Blueprint $table) {
            $table->dropForeign(['alamat_pengiriman_id']);
            $table->dropColumn([
                'total_biaya',
                'jenis_order',
                'status',
                'bukti_transfer',
                'catatan_order',
                'alamat_pengiriman_id',
            ]);
        });
    }
}
