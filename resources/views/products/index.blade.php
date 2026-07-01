<x-app-layout>
    <x-slot name="header_scripts">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <style>
            .dataTables_wrapper .dataTables_filter input, 
            .dataTables_wrapper .dataTables_length select {
                border: 1px solid #d1d5db !important;
                border-radius: 0.375rem !important;
                padding: 0.25rem 0.5rem !important;
            }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Daftar Produk Sneakers</h3>
                    <a href="{{ route('products.create') }}" style="background-color: #2563eb; color: #ffffff; font-weight: bold; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block;">
                        + Tambah Produk Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table id="datatable" class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Brand</th>
                                <th>Kategori</th>
                                <th>Ukuran</th>
                                <th>Warna</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="py-4">
                                @if($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar)))
                                    <img src="{{ asset('uploads/products/' . $product->gambar) }}" alt="Sneakers" class="w-16 h-16 object-cover rounded shadow-sm">
                                @else
                                    <span class="text-xs text-gray-400">No Image</span>
                                @endif
                                </td>
                                <td class="font-semibold text-gray-800 py-4">{{ $product->nama_produk }}</td>
                                <td>{{ $product->brand->nama_brand ?? 'N/A' }}</td>
                                <td>{{ $product->category->nama_kategori ?? 'N/A' }}</td>
                                <td class="text-gray-600">{{ $product->ukuran }}</td>
                                <td class="text-gray-600">{{ $product->warna }}</td>
                                <td class="font-medium text-green-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td>{{ $product->stok }} pasang</td>
                                <td>
                                    @if($product->is_featured)
                                        <span style="background-color: #fef3c7; color: #d97706; padding: 2px 8px; border-radius: 9999px; font-size: 11px; font-weight: bold;">Featured</span>
                                    @else
                                        <span style="background-color: #f3f4f6; color: #6b7280; padding: 2px 8px; border-radius: 9999px; font-size: 11px;">Standard</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                <div class="flex flex-col items-center space-y-2 py-2">
        
                                <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:text-blue-900 font-semibold text-sm">
                                    Lihat
                                </a>
        
                                <a href="{{ route('products.edit', $product->id) }}" class="text-amber-600 hover:text-amber-900 font-semibold text-sm">
                                    Edit
                                </a>
        
                                <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" class="block">
                                @csrf
                                @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $product->id }}')" class="text-red-600 hover:text-red-900 font-semibold text-sm cursor-pointer">
                                    Hapus
                                    </button>
        </form>

    </div>
</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <x-slot name="footer_scripts">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>

        @if(session('notification'))
        <script>
            Swal.fire({
                title: "{{ session('notif_title') }}",
                text: "{{ session('notif_text') }}",
                icon: "{{ session('notif_icon') }}",
                confirmButtonText: 'OK'
            });
        </script>
        @endif

        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Yakin?',
                    text: "Produk ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>