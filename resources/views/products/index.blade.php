<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Sneakers Vault') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Data Stok Sepatu</h3>
                    <a href="{{ route('products.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-sm transition">
                        + Tambah Produk
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Fitur</th>
                                <th class="px-4 py-3 text-right font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        @if($product->gambar)
                                            <img src="{{ asset('storage/' . $product->gambar) }}" class="h-16 w-16 object-cover rounded-md shadow-sm border" alt="{{ $product->nama_produk }}">
                                        @else
                                            <div class="h-16 w-16 bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-[10px]">No Image</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="font-bold text-gray-900">{{ $product->nama_produk }}</div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-tighter">Warna: {{ $product->warna }} | Size: {{ $product->ukuran }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                                            {{ $product->brand->nama_brand ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="bg-purple-100 text-purple-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                                            {{ $product->category->nama_kategori ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-gray-900 font-semibold">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium {{ $product->stok < 5 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $product->stok }} pcs
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        @if($product->is_featured)
                                            <span class="text-yellow-500 text-lg" title="Produk Unggulan">★</span>
                                        @else
                                            <span class="text-gray-300 text-lg">☆</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-right font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-600 hover:text-yellow-900 bg-yellow-50 px-2 py-1 rounded">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-2 py-1 rounded" onclick="return confirm('Hapus produk {{ $product->nama_produk }}?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>