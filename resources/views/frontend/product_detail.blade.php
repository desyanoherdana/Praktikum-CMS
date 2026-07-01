<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $product->nama_produk }} - Sneakers Vault</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="max-w-4xl mx-auto px-4 py-12">
        <a href="{{ route('public.products') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 inline-block mb-6">
            ← Kembali ke Katalog
        </a>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex items-center justify-center bg-gray-50 p-4 rounded-lg border border-gray-100">
                @if($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar)))
                    <img src="{{ asset('uploads/products/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" style="width: 300px; height: 300px; object-fit: cover;" class="rounded-lg shadow-sm">
                @else
                    <span class="text-6xl">👟</span>
                @endif
            </div>

            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2 py-1 rounded">{{ $product->brand->nama_brand ?? 'No Brand' }}</span>
                <h1 class="text-2xl font-black text-gray-900 mt-3 mb-2">{{ $product->nama_produk }}</h1>
                <p class="text-2xl font-extrabold text-green-600 mb-6">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>

                <hr class="mb-4 border-gray-100">

                <div class="space-y-2 text-sm">
                    <p><strong class="text-gray-500 inline-block w-24">Kategori:</strong> <span class="font-semibold">{{ $product->category->nama_kategori ?? 'Umum' }}</span></p>
                    <p><strong class="text-gray-500 inline-block w-24">Ukuran:</strong> <span class="font-semibold">{{ $product->ukuran }}</span></p>
                    <p><strong class="text-gray-500 inline-block w-24">Warna:</strong> <span class="font-semibold">{{ $product->warna }}</span></p>
                    <p><strong class="text-gray-500 inline-block w-24">Sisa Stok:</strong> <span class="font-semibold text-amber-600">{{ $product->stok }} Pasang</span></p>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm font-bold text-gray-900 mb-2">Deskripsi Produk:</h3>
                    <p class="text-sm text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-md border border-gray-100 whitespace-pre-line">
                        {{ $product->deskripsi ?? 'Tidak ada deskripsi untuk produk ini.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>