<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Http\Controllers\UserController;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index(): View
    {
        $products = (new Product)->get_product()->latest()->paginate(4);
        return view('products.index', compact('products'));
    }

    public function lihat()
    {
        // Memerintahkan Laravel untuk mengambil 'product' BESERTA 'category' dan 'supplier'
        $products = Product::with(['category', 'supplier'])->get(); 
        
        return response()->json($products);
    }

    public function lihat_byid($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product not found'], 404);
        return response()->json($product);
    }

    public function create(): View
    {
        $categories = ProductCategory::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:10240',
            'title' => 'required|min:4',
            'id_supplier' => 'required|integer',
            'product_category_id' => 'required|integer',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->store('image', 'public');
            (new Product)->storeProduct($request, $request->file('image'));
            return redirect()->route('products.index')->with('success', 'Data berhasil disimpan!');
        }

        return redirect()->route('products.index')->with('error', 'Gagal mengunggah gambar.');
    }

    // 2. CREATE (Menerima data dari NodeJS + Gambar)
    public function tambah(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        // Default nama gambar jika user tidak upload
        $imageName = 'default.png';

        // CEK GAMBAR DARI NODEJS
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Simpan ke folder: storage/app/public/image
            $image->store('image', 'public');
            // Ambil nama file acak (contoh: jd8s7ds8.jpg)
            $imageName = $image->hashName();
        }

        // Mapping Data:
        // NodeJS kirim 'name' -> Kita simpan ke 'title'
        // NodeJS tidak kirim 'id_supplier' dll -> Kita kasih nilai default 1
        $product = Product::create([
            'title' => $request->name,
            'description' => $request->description ?? '-',
            'price' => $request->price,
            'stock' => $request->stock,
            
            // Simpan nama file gambar yang benar
            'image' => $imageName,
            'id_supplier' => 1,          // Pastikan ada supplier id 1 di DB
            'product_category_id' => 1   // Pastikan ada kategori id 1 di DB
        ]);

        return response()->json($product, 201);
    }

    public function show(string $id): View
    {
        $product = (new Product)->get_product()->where('products.id', $id)->firstOrFail();
        return view('products.show', compact('product'));
    }

    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        $suppliers = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png|max:10240',
            'title' => 'required|min:4',
            'id_supplier' => 'required|integer',
            'product_category_id' => 'required|integer',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $productModel = new Product;
        $nameImage = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('image', 'public');
            $nameImage = $image->hashName();

            $dataProduct = $productModel->get_product()->where('products.id', $id)->firstOrFail();
            Storage::disk('public')->delete('image/' . $dataProduct->image);
        }

        $updateData = [
            'title' => $request->title,
            'supplier_id' => $request->id_supplier,
            'product_category_id' => $request->product_category_id,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        $productModel->updateProduct($id, $updateData, $nameImage);

        return redirect()->route('products.index')->with('success', 'Data berhasil diubah!');
    }

    // 4. UPDATE (Edit Data + Ganti Gambar)
    public function perbarui(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Siapkan data yang mau diupdate
        $updateData = [
            'title' => $request->name, // Update title pakai data name dari NodeJS
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        // CEK JIKA ADA GAMBAR BARU DIUPLOAD
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama (kecuali default.png)
            if ($product->image != 'default.png') {
                Storage::disk('public')->delete('image/' . $product->image);
            }

            // 2. Simpan gambar baru
            $image = $request->file('image');
            $image->store('image', 'public');
            
            // 3. Masukkan nama gambar baru ke data update
            $updateData['image'] = $image->hashName();
        }

        // Lakukan update ke database
        $product->update($updateData);

        return response()->json($product);
    }

    public function destroy($id): RedirectResponse
    {
        $productModel = new Product;
        $product = $productModel->get_product()->where('products.id', $id)->firstOrFail();

        Storage::disk('public')->delete('image/' . $product->image);
        DB::transaction(function() use ($product) {
            $product->detailTransaksiPenjualan()->delete(); // pastikan relasi sudah ada di model Product
            $product->delete();
        });
        return redirect()->route('products.index')->with('success', 'Data berhasil dihapus!');
    }

    // 5. DELETE (Hapus Data + File Gambar)
    public function hapuskan($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        // Hapus file fisik gambar di folder storage (kecuali default)
        if ($product->image != 'default.png') {
            Storage::disk('public')->delete('image/' . $product->image);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}