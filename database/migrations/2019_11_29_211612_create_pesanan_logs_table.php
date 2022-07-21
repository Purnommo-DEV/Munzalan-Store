<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pesanan_id')->unsigned();
            $table->string('pesanan_status');
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_logs');
    }
}
