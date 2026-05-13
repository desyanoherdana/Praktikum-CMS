<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\ProductController;
use App\Models\Brand;
use App\Models\Category; 
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        $totalProduk = Product::count();
        $totalBrand = Brand::count();
        $totalKategori = Category::count();
        $stokMenipis = Product::where('stok', '<', 5)->count();

        return view('dashboard', compact('totalProduk', 'totalBrand', 'totalKategori', 'stokMenipis'));
    })->name('dashboard');

    Route::resource('brands', BrandController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';