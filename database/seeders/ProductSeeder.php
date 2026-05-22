<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = require __DIR__ . '/products_data.php';

        foreach ($products as $product) {
            $brand = Brand::firstWhere('slug', $product['brand_slug']);
            if (!$brand) {
                continue;
            }

            $data = [
                'brand_id' => $brand->id,
                'name' => $product['name'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => $product['image'],
                'description' => $product['description'] !== null ? str_replace('\\r\\n', "\n", $product['description']) : null,
                'ram' => $product['ram'],
                'storage' => $product['storage'],
                'battery' => $product['battery'],
            ];

            Product::updateOrCreate(
                ['brand_id' => $brand->id, 'name' => $product['name']],
                $data
            );
        }
    }
}
