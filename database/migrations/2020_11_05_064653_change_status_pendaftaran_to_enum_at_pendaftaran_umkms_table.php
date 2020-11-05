<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeStatusPendaftaranToEnumAtPendaftaranUmkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE pendaftaran_umkms CHANGE COLUMN status_pendaftaran status_pendaftaran ENUM('pending', 'approved') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE pendaftaran_umkms CHANGE COLUMN status_pendaftaran status_pendaftaran VARCHAR(255) NOT NULL DEFAULT 'pending'");
    }
}
