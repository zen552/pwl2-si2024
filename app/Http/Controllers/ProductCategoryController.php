<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // <-- INI YANG PALING PENTING!

class ProductCategoryController extends Controller
{
    /**
     * Menampilkan halaman utama (daftar kategori).
     */
    public function index()
    {
        $semuaKategori = ProductCategory::latest()->get();
        return view('categories.index', ['categories' => $semuaKategori]);
    }

    /**
     * Method `store` untuk menyimpan data baru via AJAX.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $validator = Validator::make($request->all(), [
            'product_category_name' => 'required|string|max:255|unique:category_product',
            'description' => 'nullable|string',
        ]);

        // 2. Jika validasi gagal, kirim response error JSON
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 3. Jika berhasil, buat data baru dan kirim response sukses JSON
        ProductCategory::create($validator->validated());
        return response()->json(['success' => 'Kategori berhasil ditambahkan!']);
    }

    /**
     * Method `update` untuk memperbarui data via AJAX.
     */
    public function update(Request $request, ProductCategory $category)
    {
        // 1. Validasi data (aturan 'unique' diubah sedikit untuk proses update)
        $validator = Validator::make($request->all(), [
            'product_category_name' => 'required|string|max:255|unique:category_product,product_category_name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // 2. Jika validasi gagal, kirim response error JSON
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 3. Jika berhasil, update data dan kirim response sukses JSON
        $category->update($validator->validated());
        return response()->json(['success' => 'Kategori berhasil diperbarui!']);
    }

    /**
     * Method `destroy` untuk menghapus data via AJAX.
     */
    public function destroy(ProductCategory $category)
    {
        // Hapus data dan kirim response sukses JSON
        $category->delete();
        return response()->json(['success' => 'Kategori berhasil dihapus!']);
    }
}