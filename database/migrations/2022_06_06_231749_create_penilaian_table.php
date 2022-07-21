<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('produk_id')->unsigned();
            $table->bigInteger('produk_pesanan_id')->unsigned();
            $table->integer('bintang');
            $table->string('gambar');
            $table->text('komentar');
            $table->timestamps();

            $table->foreign('produk_pesanan_id')->references('id')->on('pesanan_produk')->onDelete('cascade');
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
        Schema::dropIfExists('penilaian');
    }
}
