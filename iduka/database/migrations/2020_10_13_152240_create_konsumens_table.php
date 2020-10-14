<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsumens', function (Blueprint $table) {
            $table->bigIncrements('konsumen_id');
            $table->string('nama_konsumen');
            $table->string('alamat_konsumen');
            $table->string('nomor_hp');
            $table->string('gambar');
            $table->integer('user_id')->unsigned();
            $table->timestamps('tanggal_gabung');
            $table->timestamps('login_terakhir');
        });

        Schema::table('konsumens', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsumens');
    }
}
