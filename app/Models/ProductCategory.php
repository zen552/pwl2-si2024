<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit karena nama modelnya beda
    protected $table = 'category_product';

    // Mendefinisikan kolom mana saja yang boleh diisi secara massal
    // Ini penting untuk keamanan
    protected $fillable = [
        'product_category_name',
        'description',
    ];
}