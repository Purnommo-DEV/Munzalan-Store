<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('alamat_id')->unsigned();
            $table->string('total_bayar');
            $table->string('total_berat');
            $table->string('metode_pembayaran');
            $table->string('status_pesanan');
            $table->string('ongkos_kirim');
            $table->string('pengiriman');
            $table->string('resi');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('alamat_id')->references('id')->on('alamat_pengiriman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('pesanan');
    }
}
