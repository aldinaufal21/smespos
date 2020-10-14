<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('produk_id');
            $table->string('nama_produk');
            $table->string('gambar_produk');
            $table->string('deskripsi_produk');
            $table->bigInteger('stok');
            $table->bigInteger('kategori_produk_id')->unsigned();
            $table->dateTime('tanggal_input', 0);
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->foreign('kategori_produk_id')->references('kategori_produk_id')->on('kategori_produks');  
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
