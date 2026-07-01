<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\ProductController;
use App\Models\Brand;
use App\Models\Category; 
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. PUBLIC AREA / FRONTEND
// ==========================================

// Halaman Beranda Utama (Menampilkan Produk Unggulan & Terbaru)
Route::get('/', function () {
    // Featured
    $featuredProducts = Product::with(['brand', 'category'])->where('is_featured', true)->latest()->take(4)->get();
    // Newest
    $latestProducts = Product::with(['brand', 'category'])->latest()->take(8)->get();

    return view('frontend.home', compact('featuredProducts', 'latestProducts'));
})->name('home');

// Halaman Daftar Semua Brand
Route::get('/public/brands', function () {
    $brands = Brand::withCount('products')->latest()->get(); // Mengambil brand beserta jumlah produknya
    return view('frontend.brand', compact('brands'));
})->name('public.brands');

// Halaman Daftar Semua Kategori
Route::get('/public/categories', function () {
    $categories = Category::withCount('products')->latest()->get(); // Mengambil kategori beserta jumlah produknya
    return view('frontend.category', compact('categories'));
})->name('public.categories');

// Halaman Katalog Semua Produk Sneakers
Route::get('/public/products', function () {
    $products = Product::with(['brand', 'category'])->latest()->get(); // Mengambil semua produk dari CRUD
    return view('frontend.product', compact('products'));
})->name('public.products');

// Route untuk melihat detail produk dari sisi frontend
Route::get('/public/products/{id}', function ($id) {
    $product = Product::with(['brand', 'category'])->findOrFail($id);
    return view('frontend.product_detail', compact('product'));
})->name('public.products.detail');

// Halaman About Us
Route::get('/about', function () {
    return view('frontend.about');
})->name('about');


// ==========================================
// 2. CMS AREA / BACKEND 
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        $totalProduk = Product::count();
        $totalBrand = Brand::count();
        $totalKategori = Category::count();
        $stokMenipis = Product::where('stok', '<', 5)->count();

        return view('dashboard', compact('totalProduk', 'totalBrand', 'totalKategori', 'stokMenipis'));
    })->name('dashboard');

    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';