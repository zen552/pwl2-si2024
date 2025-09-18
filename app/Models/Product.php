<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function get_product(){
        //get all prodcuts 
        $sql = $this->select(
                        "products.*", 
                        "category_product.product_category_name as product_category_name",
                        "supplier.supplier_name as supplier_name")
                    ->join('supplier', 'supplier.id', '=', 'products.supplier_id')
                    ->join('category_product', 'category_product.id', '=', 'products.product_category_id');
        return $sql;
    }
}
