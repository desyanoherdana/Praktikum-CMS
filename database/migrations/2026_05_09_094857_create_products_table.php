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
            // Foreign Keys (Relasi ke Brand dan Category)
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
    
            // Atribut Produk
            $table->string('nama_produk'); // Contoh: Air Jordan 1 Retro
            $table->string('slug')->unique(); // Untuk URL SEO
            $table->integer('harga'); // Menggunakan integer agar mudah dihitung/format rupiah
            $table->integer('stok')->default(0); // Menjaga ketersediaan barang
            $table->string('ukuran'); // Contoh: 40, 41, 42, 43
            $table->string('warna'); // Contoh: Red White
            $table->text('deskripsi'); // Detail bahan, sejarah, atau keunggulan
            $table->string('gambar'); // File foto utama sepatu
    
            $table->boolean('is_featured')->default(false); // Untuk menampilkan di "Produk Unggulan" depan
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
