<x-app-layout>
    <x-slot name="header_scripts">
        </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Tambah Produk Sneakers Baru</h3>
                    <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Kembali ke Tabel</a>
                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk / Seri</label>
                            <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Air Jordan 1 Retro">
                            @error('nama_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                            <select name="brand_id" id="brand_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Brand --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->nama_brand }}</option>
                                @endforeach
                            </select>
                            @error('brand_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="category_id" id="category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rupiah)</label>
                            <input type="number" name="harga" id="harga" value="{{ old('harga') }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 1500000">
                            @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">Stok Awal</label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok') }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 10">
                            @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="ukuran" class="block text-sm font-medium text-gray-700 mb-2">Pilihan Ukuran</label>
                            <input type="text" name="ukuran" id="ukuran" value="{{ old('ukuran') }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 40, 41, 42, 43">
                            @error('ukuran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="warna" class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                            <input type="text" name="warna" id="warna" value="{{ old('warna') }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Red/White/Black">
                            @error('warna') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Tulis spesifikasi atau cerita tentang produk sneakers ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Foto Sneakers</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 file:cursor-pointer hover:file:bg-blue-100">
                        @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    <div class="mb-6 flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 mr-2">
                        <label for="is_featured" class="text-sm font-medium text-gray-700">Tampilkan sebagai Produk Unggulan (Featured Product)</label>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded transition">Batal</a>
                        <button type="submit" style="background-color: #2563eb; color: #ffffff; font-weight: bold; padding: 8px 20px; border-radius: 6px; border: none; cursor: pointer;">
                            Simpan Produk
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <x-slot name="footer_scripts">
        </x-slot>
</x-app-layout>