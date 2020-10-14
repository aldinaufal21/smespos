<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokOpnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_opnames', function (Blueprint $table) {
            $table->bigIncrements('stok_opname_id');
            $table->bigInteger('jumlah');
            $table->bigInteger('harga');
            $table->dateTime('tanggal_stok_opname', 0);
            $table->bigInteger('produk_id')->unsigned();
        });

        Schema::table('stok_opnames', function (Blueprint $table) {
            $table->foreign('produk_id')->references('produk_id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_opnames');
    }
}
