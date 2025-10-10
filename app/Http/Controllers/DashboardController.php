<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\TransaksiPenjualan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalSupplier = Supplier::count();
        $totalKategori = Category::count();
        $transaksiHariIni = TransaksiPenjualan::whereDate('created_at', now())->count();

        $transaksiTerbaru = TransaksiPenjualan::latest()->take(5)->get();
return view('dashboard.dashboard', compact(
    'totalProduk',
    'totalSupplier',
    'totalKategori',
    'transaksiHariIni',
    'transaksiTerbaru'
));

    }
}
