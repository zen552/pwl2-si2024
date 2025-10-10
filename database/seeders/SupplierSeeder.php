<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier; // Pastikan model Supplier ada

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menghapus data lama untuk menghindari duplikasi
        Supplier::truncate();

        // Menyiapkan data supplier dalam array
        $suppliers = [
            [
                'id' => 111,
                'supplier_name' => 'PT Mars Symbioscience Indonesia',
                'photo' => NULL,
                'pic_supplier' => 'Raiden',
                'created_at' => '2025-10-10 03:42:54',
                'updated_at' => '2025-10-10 18:52:16',
            ],
            [
                'id' => 112,
                'supplier_name' => 'PT Sinar Jaya Agung',
                'photo' => NULL,
                'pic_supplier' => 'Alvin',
                'created_at' => '2025-10-10 08:31:15',
                'updated_at' => '2025-10-10 18:51:12',
            ],
            [
                'id' => 117,
                'supplier_name' => 'PT Petshop',
                'photo' => NULL,
                'pic_supplier' => 'Vanessa',
                'created_at' => '2025-10-09 11:12:27',
                'updated_at' => '2025-10-10 18:52:46',
            ],
            [
                'id' => 118,
                'supplier_name' => 'PT Cahaya Indah',
                'photo' => NULL,
                'pic_supplier' => 'Gilberth',
                'created_at' => '2025-10-10 08:00:44',
                'updated_at' => '2025-10-10 18:53:53',
            ],
        ];

        // Memasukkan data ke dalam tabel 'suppliers'
        DB::table('supplier')->insert($suppliers);
    }
}