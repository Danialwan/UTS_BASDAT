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
        Schema::create('detail_retur', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('jumlah');
            $table->string('alasan',200);
            $table->unsignedBigInteger('idretur');
            $table->foreign('idretur')->references('id')->on('retur')->onDelete('cascade');
            $table->unsignedBigInteger('iddetail_penerimaan');
            $table->foreign('iddetail_penerimaan')->references('id')->on('detail_penerimaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_retur');
    }
};
