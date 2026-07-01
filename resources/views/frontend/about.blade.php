<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Sneakers Vault</title>
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
                    <a href="{{ route('public.products') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Product</a>
                    <a href="{{ route('about') }}" class="text-sm font-bold text-blue-600">About</a>
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

    <main class="max-w-3xl mx-auto px-4 py-12">
        <div class="bg-white p-10 rounded-xl shadow-sm border border-gray-200">
            
            <div class="text-center mb-8">
                <span class="text-5xl block mb-3">🏢</span>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tentang SNEAKERS<span class="text-blue-600">VAULT</span></h1>
                <p class="text-blue-600 font-semibold text-sm tracking-widest uppercase mt-1">The Ultimate Sneaker Destination</p>
            </div>
            
            <hr class="border-gray-100 my-6">

            <div class="space-y-6 text-base text-gray-600 leading-relaxed">
                <p>
                    Didirikan atas dasar kecintaan mendalam terhadap kultur *streetwear*, 
                    <strong>Sneakers Vault</strong> hadir sebagai jembatan terpercaya bagi para kolektor, 
                    *sneakerheads*, dan pencinta mode untuk mendapatkan koleksi alas kaki terbaik dari berbagai belahan dunia. 
                </p>

                <p>
                    Kami memahami bahwa sepasang sneakers bukan sekadar alas pelindung kaki, melainkan sebuah bentuk 
                    ekspresi diri, identitas, dan investasi gaya hidup. Oleh karena itu, Sneakers Vault berkomitmen penuh 
                    untuk hanya mengurasi produk-produk yang memiliki nilai estetika tinggi, kenyamanan maksimal, dan 
                    tren paling relevan di pasar global.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-8 pt-4">
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 text-center">
                        <span class="text-2xl block mb-1">🛡️</span>
                        <h3 class="font-bold text-gray-950 text-sm mb-1">100% Terjamin</h3>
                        <p class="text-xs text-gray-500">Seluruh produk melalui proses kurasi ketat untuk memastikan keaslian mutlak.</p>
                    </div>
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 text-center">
                        <span class="text-2xl block mb-1">🔥</span>
                        <h3 class="font-bold text-gray-950 text-sm mb-1">Koleksi Terkini</h3>
                        <p class="text-xs text-gray-500">Selalu memperbarui etalase dengan rilis terbaru dan siluet paling dicari.</p>
                    </div>
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 text-center">
                        <span class="text-2xl block mb-1">🤝</span>
                        <h3 class="font-bold text-gray-950 text-sm mb-1">Layanan Utama</h3>
                        <p class="text-xs text-gray-500">Fokus pada pengalaman pelanggan yang transparan, aman, dan memuaskan.</p>
                    </div>
                </div>

                <p>
                    Melalui integrasi katalog digital yang dinamis, kami terus berusaha memberikan kemudahan akses 
                    informasi ketersediaan produk, variasi ukuran, hingga detail spesifikasi warna secara akurat. 
                    Sneakers Vault siap menemani setiap langkah perjalanan Anda dalam mengeksplorasi gaya tanpa batas.
                </p>
            </div>

        </div>
    </main>

    <footer class="bg-gray-900 text-gray-500 py-8 text-center text-xs mt-32 border-t border-gray-800">
        <p>&copy; 2026 Sneakers Vault. All Rights Reserved.</p>
    </footer>

</body>
</html>