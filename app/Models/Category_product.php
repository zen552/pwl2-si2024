<?php
// app/Models/ProductCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Nama tabel yang benar sesuai DB Anda
    protected $table = 'category_product'; 

    protected $fillable = [
        // Sesuaikan dengan nama kolom di DB Anda: product_category_name
        'product_category_name', 
        'description',
    ];

    // Opsional: Untuk kolom created_at dan updated_at
    public $timestamps = true; 
}
