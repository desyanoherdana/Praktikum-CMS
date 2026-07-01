<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception; 

class ProductController extends Controller
{
    // 1. Tampilan Utama (Tabel Produk)
    public function index()
    {
        $products = Product::with(['brand', 'category'])->latest()->get();
        return view('products.index', compact('products'));
    }

    // 2. Tampilan Form Tambah Khusus
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('products.create', compact('brands', 'categories'));
    }

    // 3. Tampilan Detail Produk
    public function show($id)
    {
        $product = Product::with(['brand', 'category'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 4. Proses Simpan Data + Upload Gambar
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|unique:products,nama_produk|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'ukuran' => 'required|string|max:100',
            'warna' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $namaGambar = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $namaGambar = time() . '_' . Str::slug($request->nama_produk) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $namaGambar);
            }

            Product::create([
                'nama_produk' => $request->nama_produk,
                'slug' => Str::slug($request->nama_produk),
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'ukuran' => $request->ukuran,
                'warna' => $request->warna,
                'deskripsi' => $request->deskripsi,
                'is_featured' => $request->has('is_featured') ? true : false,
                'gambar' => $namaGambar,
            ]);

            return redirect()->route('products.index')->with([
                'notification' => true,
                'notif_title' => 'Berhasil!',
                'notif_text' => 'Produk baru beserta gambar berhasil ditambahkan.',
                'notif_icon' => 'success'
            ]);

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with([
                'notification' => true,
                'notif_title' => 'Gagal Menyimpan!',
                'notif_text' => 'Terjadi kesalahan sistem: ' . $e->getMessage(),
                'notif_icon' => 'error'
            ]);
        }
    }

    // 5. Tampilan Form Edit Khusus
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('products.edit', compact('product', 'brands', 'categories'));
    }

    // 6. Proses Update Data + Validasi Gambar Opsional 
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|max:255|unique:products,nama_produk,' . $id,
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'ukuran' => 'required|string|max:100',
            'warna' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $namaGambar = $product->gambar; 

            if ($request->hasFile('gambar')) {
                if ($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar))) {
                    unlink(public_path('uploads/products/' . $product->gambar));
                }

                $file = $request->file('gambar');
                $namaGambar = time() . '_' . Str::slug($request->nama_produk) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $namaGambar);
            }

            $product->update([
                'nama_produk' => $request->nama_produk,
                'slug' => Str::slug($request->nama_produk),
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'ukuran' => $request->ukuran,
                'warna' => $request->warna,
                'deskripsi' => $request->deskripsi,
                'is_featured' => $request->has('is_featured') ? true : false,
                'gambar' => $namaGambar,
            ]);

            return redirect()->route('products.index')->with([
                'notification' => true,
                'notif_title' => 'Diperbarui!',
                'notif_text' => 'Data produk berhasil diubah.',
                'notif_icon' => 'success'
            ]);

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with([
                'notification' => true,
                'notif_title' => 'Gagal Mengubah!',
                'notif_text' => 'Gagal memperbarui data karena masalah teknis.',
                'notif_icon' => 'error'
            ]);
        }
    }

    // 7. Proses Hapus Data + Hapus Gambar Berkas fisik
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar))) {
                unlink(public_path('uploads/products/' . $product->gambar));
            }

            $product->delete();

            return redirect()->route('products.index')->with([
                'notification' => true,
                'notif_title' => 'Dihapus!',
                'notif_text' => 'Produk berhasil dihapus.',
                'notif_icon' => 'success'
            ]);

        } catch (Exception $e) {
            return redirect()->route('products.index')->with([
                'notification' => true,
                'notif_title' => 'Gagal Dihapus!',
                'notif_text' => 'Data gagal dihapus atau sudah tidak ada di sistem.',
                'notif_icon' => 'error'
            ]);
        }
    }
}