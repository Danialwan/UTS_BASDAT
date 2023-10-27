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
        Schema::create('detail_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('harga_satuan');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->unsignedBigInteger('idbarang');
            $table->foreign('idbarang')->references('id')->on('barang')->onDelete('cascade');
            $table->unsignedBigInteger('idpengadaan');
            $table->foreign('idpengadaan')->references('id')->on('pengadaan')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengadaan');
    }
};
