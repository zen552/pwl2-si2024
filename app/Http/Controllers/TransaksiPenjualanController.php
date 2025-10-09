<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPenjualan;
use App\Models\Product; // Asumsi Anda punya model Product
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Untuk database transaction

class TransaksiPenjualanController extends Controller
{
    /**
     * VIEW: Menampilkan semua transaksi.
     */
    public function index()
    {
        // Mengambil semua data transaksi beserta detailnya (Eager Loading)
        // with('details.product') -> ambil relasi 'details', dan di dalam 'details' ambil relasi 'product'
        $transaksis = TransaksiPenjualan::with('details.product')->latest()->paginate(10);
        
        // Mengirim data ke view (Anda perlu membuat file view ini)
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * CREATE (FORM): Menampilkan form untuk membuat transaksi baru.
     */
    public function create()
    {
        $products = Product::orderBy('title')->get();
        return view('transaksi.create', compact('products'));
    }

    /**
     * CREATE (ACTION): Menyimpan transaksi baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kasir' => 'required|string|max:50',
            'email_pembeli' => 'nullable|email',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.jumlah' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // 1. Simpan data transaksi utama
            $transaksi = TransaksiPenjualan::create([
                'nama_kasir' => $request->nama_kasir,
                'email_pembeli' => $request->email_pembeli,
            ]);

            // 2. Simpan detail transaksi dan kurangi stok
            foreach ($request->products as $productData) {
                // Simpan item ke detail_transaksi_penjualan
                $transaksi->details()->create([
                    'id_product' => $productData['id'],
                    'jumlah_pembelian' => $productData['jumlah'],
                ]);

                // Kurangi stok produk
                $product = Product::find($productData['id']);
                $product->stock -= $productData['jumlah'];
                $product->save();
            }

            DB::commit(); // Jika semua berhasil, simpan permanen

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack(); // Jika ada error, batalkan semua perubahan
            return redirect()->back()->with('error', 'Gagal membuat transaksi: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show
     * 
     * 
     */
    public function show(TransaksiPenjualan $transaksi)
    {
    // Eager load relasi untuk efisiensi
    $transaksi->load('details.product');
    return view('transaksi.show', compact('transaksi'));
    }
    
    /**
     * UPDATE (FORM): Menampilkan form untuk mengedit transaksi.
     * (Catatan: Mengedit transaksi yang sudah jadi biasanya kompleks,
     * seringkali yang diizinkan hanya update status, bukan item.
     * Contoh ini adalah simplified update)
     */
    public function edit(TransaksiPenjualan $transaksi)
    {
        $products = Product::orderBy('title')->get();
        // Load relasi detail untuk digunakan di form
        $transaksi->load('details');
        
        return view('transaksi.edit', compact('transaksi', 'products'));
    }

    /**
     * UPDATE (ACTION): Memperbarui data transaksi di database.
     */
    public function update(Request $request, TransaksiPenjualan $transaksi)
    {
        // Logika update bisa mirip dengan store:
        // 1. Validasi
        // 2. Mulai DB Transaction
        // 3. Update data utama transaksi
        // 4. Hapus detail lama, buat detail baru (atau logika yang lebih kompleks)
        // 5. Kembalikan stok lama, kurangi stok baru
        // 6. Commit atau Rollback
        // (Untuk saat ini kita skip implementasi detailnya karena sangat bergantung pada business logic)
        
        $request->validate([
            'nama_kasir' => 'required|string|max:50',
            'email_pembeli' => 'nullable|email',
        ]);

        $transaksi->update($request->only(['nama_kasir', 'email_pembeli']));

        return redirect()->route('transaksi.index')->with('success', 'Data kasir berhasil diupdate.');
    }

    /**
     * DELETE: Menghapus transaksi dari database.
     */
    public function destroy(TransaksiPenjualan $transaksi)
    {
        // Logika untuk mengembalikan stok produk sebelum menghapus
        // DB::transaction(function() use ($transaksi) {
        //     foreach($transaksi->details as $detail) {
        //         Product::find($detail->id_product)->increment('stock', $detail->jumlah_pembelian);
        //     }
        //     $transaksi->delete(); // Ini akan otomatis menghapus detailnya karena onDelete('cascade')
        // });
        
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}