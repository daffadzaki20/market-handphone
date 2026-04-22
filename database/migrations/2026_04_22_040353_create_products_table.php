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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // nama produk
        $table->foreignId('brand_id')->constrained()->onDelete('cascade'); // relasi ke brands
        $table->integer('price'); // harga
        $table->text('description')->nullable(); // deskripsi
        $table->string('image')->nullable(); // gambar
        $table->timestamps();
    });
}
};
