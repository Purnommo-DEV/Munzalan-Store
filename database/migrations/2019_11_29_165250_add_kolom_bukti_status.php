<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKolomBuktiStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfer_pembayaran', function (Blueprint $table) {
            $table->string('bukti_bayar')->after('nomor_rekening');
            $table->string('status_bayar')->after('bukti_bayar');
            $table->string('status_verifikasi')->after('status_bayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfer_pembayaran', function (Blueprint $table) {
            //
        });
    }
}
