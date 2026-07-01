<x-app-layout>
    <x-slot name="header_scripts">
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow-sm">
                
                <div class="mb-6">
                    <a href="{{ route('products.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                        ← Kembali ke Daftar Produk
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="flex flex-col items-center justify-center bg-gray-50 p-6 rounded-lg border border-gray-100 shadow-inner">
                        @if($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar)))
                            <img src="{{ asset('uploads/products/' . $product->gambar) }}" 
                                 alt="{{ $product->nama_produk }}" 
                                 style="width: 300px; height: 300px; object-fit: cover;" 
                                 class="rounded-xl shadow-md border border-gray-200">
                        @else
                            <div class="text-gray-400 flex flex-col items-center py-16">
                                <span class="text-5xl mb-2">👟</span>
                                <p class="text-sm font-medium">Tidak ada foto produk</p>
                            </div>
                        @endif

                        <div class="mt-4">
                            @if($product->is_featured)
                                <span style="background-color: #fef3c7; color: #d97706; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: bold;">🌟 Produk Unggulan (Featured)</span>
                            @else
                                <span style="background-color: #f3f4f6; color: #6b7280; padding: 4px 12px; border-radius: 9999px; font-size: 12px;">Produk Standar</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <span class="text-sm font-bold uppercase tracking-wider text-blue-600">{{ $product->brand->nama_brand ?? 'No Brand' }}</span>
                        <h2 class="text-2xl font-extrabold text-gray-900 mt-1 mb-2">{{ $product->nama_produk }}</h2>
                        
                        <p class="text-3xl font-black text-green-600 mb-6">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </p>

                        <hr class="border-gray-200 mb-4">

                        <div class="space-y-3 text-sm text-gray-700">
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="font-medium text-gray-500">Kategori:</span>
                                <span class="font-semibold text-gray-900">{{ $product->category->nama_kategori ?? 'No Category' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="font-medium text-gray-500">Stok Tersedia:</span>
                                <span class="font-semibold text-gray-900">{{ $product->stok }} Pasang</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="font-medium text-gray-500">Pilihan Ukuran:</span>
                                <span class="font-semibold text-gray-900">{{ $product->ukuran }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="font-medium text-gray-500">Warna:</span>
                                <span class="font-semibold text-gray-900">{{ $product->warna }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="font-medium text-gray-500">Slug URL:</span>
                                <span class="text-gray-500 italic text-xs">{{ $product->slug }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h4 class="text-sm font-bold text-gray-900 mb-2">Deskripsi / Spesifikasi:</h4>
                            <p class="text-sm text-gray-600 bg-gray-50 p-4 rounded-md border border-gray-100 leading-relaxed whitespace-pre-line">
                                {{ $product->deskripsi ?? 'Tidak ada deskripsi untuk produk ini.' }}
                            </p>
                        </div>

                        <div class="mt-6 flex space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" style="background-color: #f59e0b; color: #ffffff; font-weight: bold; padding: 10px 16px; border-radius: 6px; text-decoration: none; text-align: center; font-size: 14px; flex: 1;">
                                Edit Produk
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <x-slot name="footer_scripts">
    </x-slot>
</x-app-layout>