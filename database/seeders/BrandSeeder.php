<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
{
    $brands = [
        ['type' => 'hp', 'name' => 'Apple', 'slug' => 'apple'],
        ['type' => 'hp', 'name' => 'Samsung', 'slug' => 'samsung'],
        ['type' => 'hp', 'name' => 'Xiaomi', 'slug' => 'xiaomi'],
        ['type' => 'hp', 'name' => 'Lenovo', 'slug' => 'lenovo'],
        ['type' => 'hp', 'name' => 'Oppo', 'slug' => 'oppo'],
        ['type' => 'hp', 'name' => 'Vivo', 'slug' => 'vivo'],
        ['type' => 'hp', 'name' => 'Realme', 'slug' => 'realme'],
        ['type' => 'hp', 'name' => 'Infinix', 'slug' => 'infinix'],
        ['type' => 'aksesoris', 'name' => 'Samsung', 'slug' => 'samsung2'],
        ['type' => 'aksesoris', 'name' => 'Ugreen', 'slug' => 'ugreen'],
        ['type' => 'aksesoris', 'name' => 'Baseus', 'slug' => 'baseus'],
        ['type' => 'aksesoris', 'name' => 'Aukey', 'slug' => 'aukey'],
        ['type' => 'aksesoris', 'name' => 'JBL', 'slug' => 'jbl'],
        ['type' => 'aksesoris', 'name' => 'Anker', 'slug' => 'anker'],
        ['type' => 'aksesoris', 'name' => 'Mixio', 'slug' => 'mixio'],
    ];

    foreach ($brands as $brand) {
        Brand::updateOrCreate(
            ['slug' => $brand['slug']], // Cek berdasarkan slug agar tidak duplikat
            $brand
        );
    }

}
}