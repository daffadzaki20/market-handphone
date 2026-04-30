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
            ['type' => 'aksesoris', 'name' => 'Anker', 'slug' => 'anker'],
            ['type' => 'aksesoris', 'name' => 'Ugreen', 'slug' => 'ugreen'],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['slug' => $brand['slug']],
                $brand
            );
        }

        // Tambah beberapa brand random lewat factory yang juga mengisi 'type'
        Brand::factory()->count(5)->create();
    }
}