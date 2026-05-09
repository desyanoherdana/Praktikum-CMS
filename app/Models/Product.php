<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'nama_produk',
        'slug',
        'harga',
        'stok',
        'ukuran',
        'warna',
        'deskripsi',
        'gambar',
        'is_featured',
    ];

    // Relasi ke Brand (Satu produk milik satu Brand)
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relasi ke Category (Satu produk milik satu Kategori)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}