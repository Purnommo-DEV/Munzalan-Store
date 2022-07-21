<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKolomIdKotaProvinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alamat_pengiriman', function (Blueprint $table) {
            $table->bigInteger('provinsi_id')->unsigned()->after('negara')->nullable();
            $table->bigInteger('kota_id')->unsigned()->after('provinsi_id')->nullable();

            $table->foreign('provinsi_id')->references('id')->on('provinsi')->onDelete('cascade');
            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alamat_pengiriman', function (Blueprint $table) {
            //
        });
    }
}
