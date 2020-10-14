<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabangs', function (Blueprint $table) {
            $table->bigIncrements('cabang_id');
            $table->string('nama_cabang');
            $table->string('alamat_cabang');
            $table->string('jumlah_karyawan');
            $table->string('gambar_karyawan');
            $table->integer('umkm_id')->unsigned();
            $table->integer('user_id')->unsigned();

        });

        Schema::table('cabangs', function (Blueprint $table) {
            $table->foreign('umkm_id')->references('umkm_id')->on('umkms');    
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
        Schema::dropIfExists('cabangs');
    }
}
