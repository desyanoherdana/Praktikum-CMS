<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal (Mass Assignment).
     * Sesuaikan dengan nama kolom di file migrasi kamu.
     */
    protected $fillable = [
        'nama_kategori',
        'slug',
    ];

    /**
     * Relasi: Satu Kategori memiliki banyak Produk.
     * Nama fungsi 'products' (jamak) karena hasilnya adalah kumpulan data.
     */
    public function products()
    {
        // Category has many Products
        return $this->hasMany(Product::class);
    }
}