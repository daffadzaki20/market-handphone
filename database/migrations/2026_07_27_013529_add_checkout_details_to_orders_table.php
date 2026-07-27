<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->integer('subtotal')->default(0)->after('status');
        $table->integer('ongkir')->default(0)->after('subtotal');
        $table->integer('biaya_layanan')->default(0)->after('ongkir');
        $table->integer('proteksi')->default(0)->after('biaya_layanan');
        $table->integer('diskon_voucher')->default(0)->after('proteksi');
        $table->string('metode_pengiriman')->nullable()->after('diskon_voucher');
        $table->string('metode_pembayaran')->nullable()->after('metode_pengiriman');
        $table->text('pesan')->nullable()->after('metode_pembayaran');
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn([
            'subtotal', 'ongkir', 'biaya_layanan', 'proteksi', 
            'diskon_voucher', 'metode_pengiriman', 'metode_pembayaran', 'pesan'
        ]);
    });
}
};
