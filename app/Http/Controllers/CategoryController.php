<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori|max:255',
        ]);

        try {
            Category::create([
                'nama_kategori' => $request->nama_kategori,
                'slug' => Str::slug($request->nama_kategori),
            ]);

            return redirect()->route('categories.index')->with([
                'notification' => true,
                'notif_title' => 'Berhasil!',
                'notif_text' => 'Kategori baru berhasil ditambahkan.',
                'notif_icon' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with([
                'notification' => true,
                'notif_title' => 'Gagal Menyimpan!',
                'notif_text' => 'Gagal menyimpan kategori karena kendala sistem.',
                'notif_icon' => 'error'
            ]);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|max:255|unique:categories,nama_kategori,' . $id,
        ]);

        try {
            $category->update([
                'nama_kategori' => $request->nama_kategori,
                'slug' => Str::slug($request->nama_kategori),
            ]);

            return redirect()->route('categories.index')->with([
                'notification' => true,
                'notif_title' => 'Diperbarui!',
                'notif_text' => 'Nama kategori berhasil diubah.',
                'notif_icon' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with([
                'notification' => true,
                'notif_title' => 'Gagal Mengubah!',
                'notif_text' => 'Gagal memperbarui kategori karena kendala sistem.',
                'notif_icon' => 'error'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('categories.index')->with([
                'notification' => true,
                'notif_title' => 'Dihapus!',
                'notif_text' => 'Kategori berhasil dihapus.',
                'notif_icon' => 'success'
            ]);
        } catch (Exception $e) {
            // Menangkap error jika kategori masih terikat dengan produk di database
            return redirect()->route('categories.index')->with([
                'notification' => true,
                'notif_title' => 'Gagal Dihapus!',
                'notif_text' => 'Kategori tidak bisa dihapus karena masih digunakan oleh produk sneakers!',
                'notif_icon' => 'error'
            ]);
        }
    }
}