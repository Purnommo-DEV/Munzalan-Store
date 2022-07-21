<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_produk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pesanan_id')->unsigned();
            $table->bigInteger('produk_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nama_produk');
            $table->string('ukuran_produk');
            $table->string('harga_produk');
            $table->string('kuantitas');
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
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
        Schema::dropIfExists('pesanan_produk');
    }
}
