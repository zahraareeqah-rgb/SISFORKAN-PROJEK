<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_peminjaman')->constrained('peminjaman')->onDelete('cascade');
            $table->foreignId('id_buku')->constrained('buku')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman_buku');
    }
};
