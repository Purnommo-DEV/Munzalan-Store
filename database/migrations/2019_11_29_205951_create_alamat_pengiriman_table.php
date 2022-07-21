<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->text('alamat')->nullable();
            $table->string('negara')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('alamat_pengiriman');
    }
}
