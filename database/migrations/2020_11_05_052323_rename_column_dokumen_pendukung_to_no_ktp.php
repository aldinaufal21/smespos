<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnDokumenPendukungToNoKtp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendaftaran_umkms', function (Blueprint $table) {
            $table->renameColumn('dokumen_pendukung', 'no_ktp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendaftaran_umkms', function (Blueprint $table) {
            $table->renameColumn('no_ktp', 'dokumen_pendukung');
        });
    }
}
