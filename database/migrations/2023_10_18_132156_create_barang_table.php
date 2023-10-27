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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('jenis',1);
            $table->string('nama', 45);
            $table->unsignedBigInteger('idsatuan');
            $table->foreign('idsatuan')->references('id')->on('satuan');
            $table->tinyInteger('status');
            $table->integer('harga');
            $table->boolean('Delete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
