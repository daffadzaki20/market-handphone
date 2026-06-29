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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (siapa pemilik metode pembayaran ini)
            // cascadeOnDelete memastikan jika user dihapus, data banknya ikut terhapus
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Jenis metode pembayaran (contoh: 'kartu', 'rekening', 'ewallet')
            $table->string('type'); 
            
            // Nama penyedia layanan (contoh: 'Credit/Debit Card', 'BCA', 'Gopay')
            $table->string('provider'); 
            
            // Nama pemilik yang tertera di rekening/kartu
            $table->string('account_name');
            
            // Nomor rekening atau kartu (hanya 4 digit terakhir yang utuh untuk kartu)
            $table->string('account_number'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};