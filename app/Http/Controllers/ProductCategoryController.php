<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory; // Panggil model ProductCategory
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    // Method untuk menampilkan semua data kategori (halaman utama)
    public function index()
    {
        $categories = ProductCategory::latest()->get(); // Ambil semua data, urutkan dari yg terbaru
        return view('categories.index', compact('categories'));
    }

    // Method untuk menampilkan halaman form tambah data
    public function create()
    {
        return view('categories.create');
    }

    // Method untuk menyimpan data baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Simpan data baru
        ProductCategory::create($request->all());

        // Alihkan kembali ke halaman utama dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    // Method untuk menampilkan detail satu kategori (view)
    public function show(ProductCategory $category)
    {
        return view('categories.show', compact('category'));
    }

    // Method untuk menampilkan halaman form edit data
    public function edit(ProductCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Method untuk memperbarui data di database
    public function update(Request $request, ProductCategory $category)
    {
        // Validasi input
        $request->validate([
            'product_category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update data yang ada
        $category->update($request->all());

        // Alihkan kembali ke halaman utama dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Method untuk menghapus data
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}