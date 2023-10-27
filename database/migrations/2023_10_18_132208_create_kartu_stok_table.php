<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kartu_stok', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('jenis_transaksi',1);
            $table->integer('masuk');
            $table->integer('keluar');
            $table->integer('stock');
            $table->integer('id_transaksi');
            $table->unsignedBigInteger('idbarang');
            $table->foreign('idbarang')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_stok');
    }
};
