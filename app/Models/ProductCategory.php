<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Menentukan nama tabelnya secara manual
    protected $table = 'category_product';

    // Kolom yang boleh diisi
    protected $fillable = [
        'product_category_name',
        'description',
    ];
}