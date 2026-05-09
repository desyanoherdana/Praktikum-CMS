<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Brand Sepatu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Brand Aktif</h3>
                    <a href="{{ route('brands.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Brand Baru
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Brand</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug (URL)</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($brands as $brand)
                            <tr>
                                <td class="px-6 py-4">
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="Logo" class="h-10 w-10 object-contain">
                                    @else
                                        <span class="text-gray-400 italic text-xs">No Logo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold">{{ $brand->nama_brand }}</td>
                                <td class="px-6 py-4 text-gray-600 text-sm italic">/brand/{{ $brand->slug }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('brands.edit', $brand->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus brand ini?')">Hapus</button>
                                    </form>
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
</x-app-layout>