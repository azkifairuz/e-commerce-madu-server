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
        Schema::create('detail_keranjang_belanja', function (Blueprint $table) {
            $table->id();
            $table->integer('id_keranjang_belanja');
            $table->integer('id_pelanggan');
            $table->integer('id_produk');
            $table->integer('qty');
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_keranjang_belanjas');
    }
};
