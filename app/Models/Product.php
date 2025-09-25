<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * fillable
     * 
     * @var array
     */    
    protected $fillable = [
        'image',
        'title',
        'product_category_id',
        'supplier_id',
        'description',
        'price',
        'stock',
    ];

    public function get_product(){
        //get all prodcuts 
        $sql = $this->select(
                        "products.*", 
                        "category_product.product_category_name as product_category_name",
                        "supplier.supplier_name as supplier_name")
                    ->leftjoin('supplier', 'supplier.id', '=', 'products.supplier_id')
                    ->leftjoin('category_product', 'category_product.id', '=', 'products.product_category_id');
        return $sql;
    }

    public static function storeProduct($request, $image)
    {
        //simpan produk baru menggunakan mass assignment
        return self::create([
            'image'                 => $image->hashName(),
            'title'                 => $request->title,
            'supplier_id'           => $request->supplier,
            'product_category_id'   => $request->product_category_id,
            'description'           => $request->description,
            'price'                 => $request->price,
            'stock'                 => $request->stock
        ]);
    }
}
