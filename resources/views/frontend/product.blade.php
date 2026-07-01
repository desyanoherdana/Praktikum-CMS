<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - Sneakers Vault</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">👟</span>
                    <a href="{{ route('home') }}" class="text-xl font-black tracking-tight text-gray-900">
                        SNEAKERS<span class="text-blue-600">VAULT</span>
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Home</a>
                    <a href="{{ route('public.brands') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Brand</a>
                    <a href="{{ route('public.categories') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Category</a>
                    <a href="{{ route('public.products') }}" class="text-sm font-bold text-blue-600">Product</a>
                    <a href="{{ route('about') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">About</a>
                    <span class="text-gray-300">|</span>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition shadow-sm">Dashboard Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Login</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight flex items-center gap-2">
                <span>🔥</span> Semua Koleksi Sneakers
            </h1>
            <p class="text-gray-500 text-sm mt-1">Klik produk pilihan Anda untuk melihat detail spesifikasi ukuran, warna, dan deskripsi lengkap.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div onclick="window.location='{{ route('public.products.detail', $product->id) }}'" 
                     class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 cursor-pointer transition transform hover:-translate-y-1 hover:shadow-md group">
                    
                    <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center overflow-hidden border-b border-gray-100 relative">
                        @if($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar)))
                            <img src="{{ asset('uploads/products/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-4xl">👟</span>
                        @endif
                        <span class="absolute bottom-3 right-3 bg-gray-900/80 backdrop-blur-sm text-white text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider">
                            {{ $product->category->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <div class="p-5">
                        <span class="text-[10px] font-extrabold text-blue-600 uppercase tracking-widest">
                            {{ $product->brand->nama_brand ?? 'No Brand' }}
                        </span>
                        <h3 class="font-black text-gray-900 text-lg mt-0.5 truncate group-hover:text-blue-700 transition">
                            {{ $product->nama_produk }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-1">Size: {{ $product->ukuran }} | Warna: {{ $product->warna }}</p>
                        
                        <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100">
                            <span class="text-lg font-black text-green-600">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded border border-gray-100">
                                Stok: {{ $product->stok }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-20 bg-white rounded-xl border border-dashed border-gray-300">
                    <span class="text-5xl block mb-3">📦</span>
                    <p class="text-gray-400 text-sm font-medium">Belum ada produk sneakers yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-500 py-8 text-center text-xs mt-24 border-t border-gray-800">
        <p>&copy; 2026 Sneakers Vault. All Rights Reserved.</p>
    </footer>

</body>
</html>