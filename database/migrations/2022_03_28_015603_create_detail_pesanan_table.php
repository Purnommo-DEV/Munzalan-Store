<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('pesanan_id')->unsigned();
            $table->bigInteger('produk_id')->unsigned();
            $table->string('ukuran');
            $table->integer('kuantitas');
            $table->string('harga');
            $table->enum('status_pesanan',['Dalam Proses','Berhasil Sampai']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pesanan');
    }
}
