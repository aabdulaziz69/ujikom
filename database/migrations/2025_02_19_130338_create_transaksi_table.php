<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->id('nama_barang');
            $table->string('jumlah_barang');
            $table->foreignId('id')->constrained('users');
            $table->foreignId('id_barang')->constrained()->references('id_barang')->on('barang');
            $table->string('bayar_total');
            $table->timestamp('tanggal_transaksi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }

};
