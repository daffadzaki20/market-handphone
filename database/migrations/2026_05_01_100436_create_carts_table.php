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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (siapa yang punya keranjang)
            // onDelete('cascade') artinya jika user dihapus, isi keranjangnya ikut terhapus
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relasi ke tabel products (barang apa yang dibeli)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Kolom untuk jumlah barang yang dibeli
            $table->integer('quantity')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};