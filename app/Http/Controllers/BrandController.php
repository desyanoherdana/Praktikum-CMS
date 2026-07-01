<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_brand' => 'required|unique:brands,nama_brand|max:255',
        ]);

        try {
            Brand::create([
                'nama_brand' => $request->nama_brand,
                'slug' => Str::slug($request->nama_brand),
            ]);

            return redirect()->route('brands.index')->with([
                'notification' => true,
                'notif_title' => 'Berhasil!',
                'notif_text' => 'Brand baru berhasil ditambahkan.',
                'notif_icon' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with([
                'notification' => true,
                'notif_title' => 'Gagal Menyimpan!',
                'notif_text' => 'Gagal menyimpan data karena kendala sistem.',
                'notif_icon' => 'error'
            ]);
        }
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'nama_brand' => 'required|max:255|unique:brands,nama_brand,' . $id,
        ]);

        try {
            $brand->update([
                'nama_brand' => $request->nama_brand,
                'slug' => Str::slug($request->nama_brand),
            ]);

            return redirect()->route('brands.index')->with([
                'notification' => true,
                'notif_title' => 'Diperbarui!',
                'notif_text' => 'Nama brand berhasil diubah.',
                'notif_icon' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with([
                'notification' => true,
                'notif_title' => 'Gagal Mengubah!',
                'notif_text' => 'Gagal memperbarui brand karena kendala sistem.',
                'notif_icon' => 'error'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();

            return redirect()->route('brands.index')->with([
                'notification' => true,
                'notif_title' => 'Dihapus!',
                'notif_text' => 'Brand berhasil dihapus.',
                'notif_icon' => 'success'
            ]);
        } catch (Exception $e) {
            // Menangkap error jika brand masih terikat dengan produk di database
            return redirect()->route('brands.index')->with([
                'notification' => true,
                'notif_title' => 'Gagal Dihapus!',
                'notif_text' => 'Brand tidak bisa dihapus karena masih digunakan oleh produk sneakers!',
                'notif_icon' => 'error'
            ]);
        }
    }
}