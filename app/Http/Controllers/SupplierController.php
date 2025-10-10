<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // 🔹 Tampilkan daftar supplier
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('supplier.index', compact('suppliers'));
    }

    // 🔹 Form tambah supplier
    public function create()
    {
        return view('supplier.create');
    }

    // 🔹 Simpan supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'pic_supplier' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Supplier::create([
            'supplier_name' => $request->supplier_name,
            'pic_supplier' => $request->pic_supplier,
            'phone' => $request->phone,
        ]);

        return redirect()
            ->route('suppliers.index')
            ->with('success', '✅ Supplier berhasil ditambahkan!');
    }

    // 🔹 Form edit supplier
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    // 🔹 Update data supplier
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'pic_supplier' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'supplier_name' => $request->supplier_name,
            'pic_supplier' => $request->pic_supplier,
            'phone' => $request->phone,
        ]);

        return redirect()
            ->route('suppliers.index')
            ->with('success', '✏️ Data supplier berhasil diperbarui!');
    }

    // 🔹 Hapus supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', '🗑️ Supplier berhasil dihapus!');
    }
}
