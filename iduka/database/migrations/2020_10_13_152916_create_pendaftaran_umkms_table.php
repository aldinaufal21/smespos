<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranUmkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_umkms', function (Blueprint $table) {
            $table->bigIncrements('pendaftaran_umkm_id');
            $table->string('status_pendaftaran');
            $table->string('dokumen_pendukung');
            $table->bigInteger('umkm_id')->unsigned();
            $table->bigInteger('pengelola_id')->unsigned();
            $table->timestamps('tanggal_pendaftaran');

        });

        Schema::table('pendaftaran_umkms', function (Blueprint $table) {
            $table->foreign('umkm_id')->references('umkm_id')->on('umkms');
            $table->foreign('pengelola_id')->references('pengelola_id')->on('pengelolas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_umkms');
    }
}
