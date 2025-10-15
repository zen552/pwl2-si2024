<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;
use Illuminate\Http\Request;


class ProductCategoryController extends Controller
{
    public function index()
    {
           $categories = ProductCategory::latest()->paginate(4);

    return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProductCategory::create($request->all());


        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function show(ProductCategory $category)
    {
        return view('categories.show', compact('category'));
    }

    
    public function edit(ProductCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

   
    public function update(Request $request, ProductCategory $category)
    {
       
        $request->validate([
            'product_category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        
        $category->update($request->all());

        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

   
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}