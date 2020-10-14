<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_produks', function (Blueprint $table) {
            $table->bigIncrements('kategori_produk_id');
            $table->string('nama_kategori');
        });

        Schema::table('kategori_produks', function (Blueprint $table) {
            $table->foreign('umkm_id')->references('umkm_id')->on('umkms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_produks');
    }
}
