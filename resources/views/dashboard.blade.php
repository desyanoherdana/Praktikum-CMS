<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ __('Dashboard Ringkasan Inventaris') }}

        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

           

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

               

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b-4 border-blue-500 hover:shadow-lg transition-shadow duration-300">

                    <div class="p-6">

                        <div class="flex items-center">

                            <div class="p-3 bg-blue-100 rounded-full">

                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>

                            </div>

                            <div class="ml-4">

                                <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Total Produk</p>

                                <p class="text-2xl font-extrabold text-gray-800">{{ $totalProduk }}</p>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b-4 border-purple-500 hover:shadow-lg transition-shadow duration-300">

                    <div class="p-6">

                        <div class="flex items-center">

                            <div class="p-3 bg-purple-100 rounded-full">

                                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>

                            </div>

                            <div class="ml-4">

                                <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Brand</p>

                                <p class="text-2xl font-extrabold text-gray-800">{{ $totalBrand }}</p>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b-4 border-green-500 hover:shadow-lg transition-shadow duration-300">

                    <div class="p-6">

                        <div class="flex items-center">

                            <div class="p-3 bg-green-100 rounded-full">

                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>

                            </div>

                            <div class="ml-4">

                                <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Kategori</p>

                                <p class="text-2xl font-extrabold text-gray-800">{{ $totalKategori }}</p>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b-4 border-red-500 hover:shadow-lg transition-shadow duration-300">

                    <div class="p-6">

                        <div class="flex items-center">

                            <div class="p-3 bg-red-100 rounded-full">

                                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>

                            </div>

                            <div class="ml-4">

                                <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Stok Rendah</p>

                                <p class="text-2xl font-extrabold text-red-600">{{ $stokMenipis }}</p>

                            </div>

                        </div>

                    </div>

                </div>



            </div>



            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-8 border-gray-800">

                <div class="p-8">

                    <h3 class="text-lg font-bold text-gray-900 mb-2">

                        Selamat datang kembali, {{ Auth::user()->name }}! 👋

                    </h3>

                    <p class="text-gray-600 leading-relaxed">

                        Anda masuk ke sistem manajemen <strong>Sneakers Vault</strong>.

                        Saat ini sistem menampilkan data ringkasan secara <em>real-time</em> dari database.

                        Anda dapat mengelola item melalui menu di navigasi atas.

                    </p>

                   

                    @if($stokMenipis > 0)

                    <div class="mt-4 p-4 bg-red-50 border-l-4 border-red-400 text-red-700">

                        <p class="text-sm font-medium">

                            <strong>Perhatian:</strong> Ada {{ $stokMenipis }} produk yang stoknya hampir habis. Segera lakukan pengecekan di menu produk!

                        </p>

                    </div>

                    @else

                    <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700">

                        <p class="text-sm font-medium">

                            Status: Semua stok produk terpantau aman.

                        </p>

                    </div>

                    @endif

                </div>

            </div>

           

        </div>

    </div>

</x-app-layout> 

