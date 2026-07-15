<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // 1. Kolom yang boleh diisi 
    protected $fillable = [
        'nama_brand', 
        'slug', 
        'logo'
    ];

    // 2. Hubungan: Satu Brand punya banyak Produk (HasMany)
    // Sama seperti contoh Category 
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}