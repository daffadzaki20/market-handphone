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
        Schema::table('payment_methods', function (Blueprint $table) {
            // Menambahkan kolom baru
            $table->string('masa_berlaku', 5)->nullable(); // Format MM/YY
            $table->string('cvv', 4)->nullable();         // Simpan sebagai string
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn(['masa_berlaku', 'cvv']);
        });
    }
};