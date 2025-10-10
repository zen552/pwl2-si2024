<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar', // <-- TAMBAHKAN INI
        'product_category_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}