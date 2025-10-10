<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $semuaProduk = Product::with('kategori')->latest()->get();
        return view('products.index', ['products' => $semuaProduk]);
    }

    public function create()
    {
        $semuaKategori = ProductCategory::orderBy('product_category_name')->get();
        return view('products.create', ['categories' => $semuaKategori]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required',
            'nama_produk' => 'required|string|max:255',
            'product_category_id' => 'required|exists:category_product,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);
    
        // Langsung simpan path file apa adanya
        $pathFile = $request->gambar; // Misal: D:\Downloads\kucing.jpg
    
        Product::create([
            'gambar' => $pathFile,
            'nama_produk' => $request->nama_produk,
            'product_category_id' => $request->product_category_id,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);
    
        return redirect()->route('products.index')->with('sukses', 'Produk berhasil ditambahkan!');
    }
        public function edit(Product $product)
    {
        $semuaKategori = ProductCategory::orderBy('product_category_name')->get();
        return view('products.edit', [
            'product' => $product,
            'categories' => $semuaKategori
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_produk' => 'required|string|max:255',
            'product_category_id' => 'required|exists:category_product,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $dataUpdate = $request->except('gambar');

        // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('gambar')) {
            $gambarLama = public_path('produk/' . $product->gambar);
            if (file_exists($gambarLama) && $product->gambar) {
                unlink($gambarLama);
            }

            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('produk'), $namaFile);
            $dataUpdate['gambar'] = $namaFile;
        }

        $product->update($dataUpdate);

        return redirect()->route('products.index')->with('sukses', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar dari folder public sebelum hapus data produk
        if ($product->gambar) {
            $gambarPath = public_path('produk/' . $product->gambar);
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('sukses', 'Produk berhasil dihapus!');
    }
}
