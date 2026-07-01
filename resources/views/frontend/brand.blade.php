<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand - Sneakers Vault</title>
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
                    <a href="{{ route('public.brands') }}" class="text-sm font-bold text-blue-600">Brand</a>
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

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight flex items-center gap-2">
                <span>🏷️</span> Kolaborasi Brand Terdaftar
            </h1>
            <p class="text-gray-500 text-sm mt-1">Daftar brand resmi mitra Sneakers Vault terintegrasi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($brands as $brand)
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col justify-between items-start hover:shadow-md transition">
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">OFFICIAL PARTNER</span>
                    <h3 class="font-black text-gray-950 text-xl mt-1">{{ $brand->nama_brand }}</h3>
                </div>
                <div class="mt-4">
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">
                        {{ $brand->products_count }} Koleksi Sepatu
                    </span>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
                <span class="text-4xl block mb-2">📦</span>
                <p class="text-gray-400 text-sm font-medium">Belum ada data brand tersedia.</p>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-500 py-8 text-center text-xs mt-44 border-t border-gray-800">
        <p>&copy; 2026 Sneakers Vault. All Rights Reserved.</p>
    </footer>

</body>
</html>