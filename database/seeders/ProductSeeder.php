<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Menggunakan DB Facade untuk insert massal
use App\Models\Product; // Pastikan model Product ada

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Opsi 1: Hapus semua data lama di tabel products agar tidak ada duplikat
        Product::truncate(); 
        
        // Opsi 2: Siapkan data dalam bentuk array
        $products = [
            [
                'id' => 2,
                'gambar' => NULL,
                'product_category_id' => 1,
                'supplier_id' => 111,
                'image' => NULL,
                'title' => 'Whiskas makanan kucing',
                'description' => 'Makanan kucing yang multi vitamin, dan bergizi',
                'price' => 312000,
                'stock' => 46,
                'created_at' => '2025-10-10 04:30:11',
                'updated_at' => '2025-10-10 10:09:50',
            ],
            [
                'id' => 3,
                'gambar' => NULL,
                'product_category_id' => 2,
                'supplier_id' => 112,
                'image' => NULL,
                'title' => 'Pedigree',
                'description' => 'Makanan Anjing yang multi vitamin dan bergizi untuk anjing',
                'price' => 340000,
                'stock' => 164,
                'created_at' => '2025-10-10 08:10:06',
                'updated_at' => '2025-10-10 10:09:43',
            ],
            [
                'id' => 4,
                'gambar' => NULL,
                'product_category_id' => 2,
                'supplier_id' => 117,
                'image' => NULL,
                'title' => 'Bolt',
                'description' => 'Makanan yang penuh nutrisi dan bergizi untuk anjing',
                'price' => 350000,
                'stock' => 100,
                'created_at' => '2025-10-09 11:16:40',
                'updated_at' => '2025-10-10 10:09:35',
            ],
            [
                'id' => 5,
                'gambar' => NULL,
                'product_category_id' => 3,
                'supplier_id' => 110,
                'image' => NULL,
                'title' => 'Leash Anjing Fashionable',
                'description' => 'Leash yang akan membuat anjing anda terlihat fashionable',
                'price' => 200000,
                'stock' => 306,
                'created_at' => '2025-10-10 08:21:01',
                'updated_at' => '2025-10-10 10:09:28',
            ],
        ];

        // Masukkan data menggunakan Model
        foreach ($products as $product) {
             Product::create($product);
        }    
    }
}