<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukFavoritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_favorits', function (Blueprint $table) {
            $table->bigIncrements('produk_favorit_id');
            $table->bigInteger('konsumen_id')->unsigned();
            $table->bigInteger('produk_id')->unsigned();

        });

        Schema::table('produk_favorits', function (Blueprint $table) {
            $table->foreign('konsumen_id')->references('konsumen_id')->on('konsumens');  
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
        Schema::dropIfExists('produk_favorits');
    }
}
