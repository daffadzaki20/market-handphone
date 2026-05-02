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
    Schema::create('alamats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('nama');
        $table->string('phone_number'); 
        
        $table->string('provinsi');
        $table->string('kabupaten');
        $table->string('kecamatan');
        $table->string('desa');
        
        $table->string('rt', 3)->nullable();
        $table->string('rw', 3)->nullable();
        $table->string('kode_pos', 10);
        $table->text('alamat_detail');
        
        $table->decimal('latitude', 10, 8);
        $table->decimal('longitude', 11, 8);
        
        // Tambahkan kolom label jika Anda menggunakannya di form
        $table->string('label')->nullable(); 
        
        $table->boolean('is_utama')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamats');
    }
};