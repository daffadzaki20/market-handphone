<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'Apple']);
        Brand::create(['name' => 'Samsung']);
        Brand::create(['name' => 'Xiaomi']);
        Brand::create(['name' => 'Oppo']);
    }
}
