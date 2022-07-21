<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_pembayaran', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('pesanan_id')->unsigned();
            $table->string('asal_bank');
            $table->string('nama_pengirim');
            $table->string('nomor_rekening');
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_pembayaran');
    }
}
