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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-lg shadow-sm h-fit">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Tambah Kategori</h3>
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Running">
                            @error('nama_kategori')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" style="background-color: #2563eb; color: #ffffff; width: 100%; font-weight: bold; padding: 12px; border-radius: 6px; border: none; cursor: pointer; display: block; text-align: center; margin-top: 10px;">
                             Simpan Kategori
                        </button>
                    </form>
                </div>

                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Daftar Kategori</h3>
                    <div class="overflow-x-auto">
                        <table id="datatable" class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th>Nama Kategori</th>
                                    <th>Slug (URL)</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr class="bg-white border-b">
                                    <td class="font-semibold text-gray-800">{{ $category->nama_kategori }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td class="text-center space-x-2">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="text-amber-600 hover:text-amber-900 font-semibold text-sm">Edit</a>
                                        
                                        <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete('{{ $category->id }}')" class="text-red-600 hover:text-red-900 font-semibold text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                    text: "Data tidak bisa dikembalikan!",
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