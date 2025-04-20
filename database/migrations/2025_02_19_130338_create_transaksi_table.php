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
            $table->foreignId('id')->constrained('users');

            $table->bigInteger('bayar_total');        // Total sebelum pajak (sudah diskon)
            $table->bigInteger('total_pajak');        // Jumlah pajak (12% dari total)
            $table->bigInteger('total_setelah_pajak'); // Total + pajak (yang dibayar pembeli)

            $table->bigInteger('uang_bayar');         // Nominal uang yang dibayar
            $table->bigInteger('kembalian');          // Selisih kembalian (boleh negatif)

            $table->timestamp('tanggal_transaksi');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }

};
