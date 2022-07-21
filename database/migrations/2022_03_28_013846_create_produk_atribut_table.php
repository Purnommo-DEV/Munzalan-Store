<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukAtributTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_atribut', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('produk_id')->unsigned();
            $table->string('ukuran');
            $table->string('stok');
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
        Schema::dropIfExists('produk_atribut');
    }
}
