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
    Schema::create('vouchers', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique(); // Kode voucher, misal: PROMO50
        $table->enum('type', ['fixed', 'percent']); // Tipe potongan: nominal tetap atau persentase
        $table->decimal('value', 12, 2); // Nilai potongan
        $table->decimal('min_spend', 12, 2)->default(0); // Minimum belanja
        $table->integer('stock')->default(0); // Jumlah kuota voucher
        $table->date('expired_at')->nullable(); // Tanggal kedaluwarsa
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
