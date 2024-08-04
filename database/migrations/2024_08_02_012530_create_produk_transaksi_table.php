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
        Schema::create('produk_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('total_harga');
            $table->boolean('konfirmasi')->default(0);
            $table->string('alamat');
            $table->string('kota');
            $table->string('kodepos');
            $table->string('notelp');
            $table->string('catatan');
            $table->string('bukti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_transaksi');
    }
};
