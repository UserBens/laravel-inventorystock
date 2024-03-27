<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Data yang akan diisi ke dalam tabel produk
         $data = [
            [
                'kode' => 'P001',
                'nama' => 'Product 1',
                'harga_jual' => 10000.00,
            ],
            [
                'kode' => 'P002',
                'nama' => 'Product 2',
                'harga_jual' => 15000.00,
            ],
            // Tambahkan data lain sesuai kebutuhan
        ];

        // Iterasi data dan masukkan ke dalam tabel produk
        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}
