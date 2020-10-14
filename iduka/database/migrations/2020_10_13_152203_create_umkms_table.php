<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->bigIncrements('umkm_id');
            $table->string('nama_umkm');
            $table->text('deskripsi');
            $table->string('alamat_umkm');
            $table->string('gambar');
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('tanggal_bergabung', 0);

        });

        Schema::table('umkms', function (Blueprint $table) {
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
        Schema::dropIfExists('umkms');
    }
}
