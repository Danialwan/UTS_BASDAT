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
        Schema::create('detail_penerimaan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('jumlah');
            $table->unsignedBigInteger('idbarang');
            $table->foreign('idbarang')->references('id')->on('barang')->onDelete('cascade');
            $table->unsignedBigInteger('idpenerimaan');
            $table->foreign('idpenerimaan')->references('id')->on('penerimaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penerimaan');
    }
};
