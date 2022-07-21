<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_produk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produk_id')->unsigned();
            $table->string('gambar1');
            $table->string('gambar2');
            $table->string('gambar3');
            $table->string('gambar4');
            $table->string('gambar5');
            $table->timestamps();

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
        Schema::dropIfExists('gambar_produk');
    }
}
