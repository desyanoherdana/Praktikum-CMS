<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sneakers Vault</title>
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
                    <a href="{{ route('home') }}" class="text-sm font-bold text-blue-600">Home</a>
                    <a href="{{ route('public.brands') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Brand</a>
                    <a href="{{ route('public.categories') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Category</a>
                    <a href="{{ route('public.products') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Product</a>
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

    <header class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white py-20 px-4 text-center mb-12">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight leading-tight">Gaya Terbaik Mulai Dari Langkahmu</h1>
            <p class="text-lg text-blue-100 mb-8 max-w-xl mx-auto">Koleksi sneakers pilihan terupdate, 100% Original, khusus untuk para Sneakerheads.</p>
            <a href="{{ route('public.products') }}" class="bg-white text-blue-700 font-bold px-8 py-3 rounded-full shadow-md hover:bg-gray-100 transition inline-block text-sm uppercase tracking-wider">Lihat Katalog Penuh</a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($featuredProducts->count() > 0)
        <section class="mb-16">
            <h2 class="text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2 mb-6">
                <span>🌟</span> Produk Unggulan Pilihan
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                <div onclick="window.location='{{ route('public.products.detail', $product->id) }}'" class="bg-white rounded-xl shadow-sm overflow-hidden border border-amber-200 relative cursor-pointer transition transform hover:-translate-y-1 hover:shadow-md group">
                    <span class="absolute top-3 left-3 bg-amber-500 text-white text-[10px] font-black px-2.5 py-1 rounded-full z-10 tracking-wider">FEATURED</span>
                    <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
                        @if($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar)))
                            <img src="{{ asset('uploads/products/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-3xl">👟</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-[10px] font-extrabold uppercase text-blue-600 mb-0.5">{{ $product->brand->nama_brand ?? 'No Brand' }}</p>
                        <h3 class="font-bold text-gray-900 text-sm truncate group-hover:text-blue-600 transition">{{ $product->nama_produk }}</h3>
                        <p class="text-xs font-black text-green-600 mt-2">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <section class="mb-12">
            <h2 class="text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2 mb-6">
                <span>⚡</span> Produk Terbaru
            </h2>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-gray-100">
                        @forelse($latestProducts as $product)
                        <tr onclick="window.location='{{ route('public.products.detail', $product->id) }}'" class="hover:bg-blue-50/50 cursor-pointer transition group">
                            <td class="p-4 w-24">
                                <div class="w-14 h-14 rounded-lg bg-gray-50 border border-gray-200 overflow-hidden flex items-center justify-center">
                                    @if($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar)))
                                        <img src="{{ asset('uploads/products/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xl">👟</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-bold text-blue-600 uppercase">{{ $product->brand->nama_brand ?? 'No Brand' }}</span>
                                    <span class="font-bold text-gray-900 text-sm group-hover:text-blue-700 transition">{{ $product->nama_produk }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-right align-middle font-black text-gray-900 text-sm">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center py-12 text-gray-400 text-sm">Belum ada koleksi produk baru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <footer class="bg-gray-900 text-gray-500 py-8 text-center text-xs mt-24 border-t border-gray-800">
        <p>&copy; 2026 Sneakers Vault. All Rights Reserved.</p>
    </footer>

</body>
</html>