<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product;

use App\Models\Category_product;
use App\Models\Supplier;
//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * create
     * 
     * @return View
     */
    public function create(): View
    {
        $category_product = new Category_product;
        $supplier         = new Supplier;

        $data['categories'] = $category_product->get_category_product()->get();
        $data['suppliers'] = $supplier->get_supplier()->get();

        return view('products.create', compact('data'));
    }

    /**
     * index
     * 
     * @return void
     */
    public function index() : View
    {
        //get all products
        $product = new Product;
        $products = $product->get_product()->latest()->paginate(10);

        //render view with products
        return view('products.index', compact('products'));
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // var_dump($request);exit;
        //validate form
        $validatedData = $request->validate([
            'image'                 => 'required|image|mimes:jpeg,jpg,png|max:10240',
            'title'                 => 'required|min:5',
            'supplier'              => 'required|integer',
            'product_category_id'   => 'required|integer',
            'description'           => 'required|min:10',
            'price'                 => 'required|numeric',
            'stock'                 => 'required|numeric'
        ]);

        //menghandle upload file gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $storage_image = $image->store('image', 'public'); // simpan gambar ke folder penyimpanan

            $product = new Product;
            $insert_product = $product->storeProduct($request, $image);

            //redirect index
            return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['error' => 'Failed to upload image (request).']);

    }
}
