<x-app-layout>
    <x-slot name="header_scripts"></x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Edit Brand</h3>
                    <a href="{{ route('brands.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Kembali</a>
                </div>

                <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama_brand" class="block text-sm font-medium text-gray-700 mb-2">Nama Brand</label>
                        <input type="text" name="nama_brand" id="nama_brand" value="{{ old('nama_brand', $brand->nama_brand) }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nama_brand')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('brands.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded transition">Batal</a>
                        <button type="submit" style="background-color: #f59e0b; color: #ffffff; font-weight: bold; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer;">
                            Update Brand
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <x-slot name="footer_scripts"></x-slot>
</x-app-layout>