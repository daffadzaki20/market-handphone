<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $brandType = $this->faker->randomElement(['hp', 'aksesoris']);

        return $this->baseDefinition($brandType);
    }

    public function handphone(): static
    {
        return $this->state(fn () => $this->baseDefinition('hp'));
    }

    public function aksesoris(): static
    {
        return $this->state(fn () => $this->baseDefinition('aksesoris'));
    }

    private function baseDefinition(string $brandType): array
    {
        $brand = Brand::query()->where('type', $brandType)->inRandomOrder()->first()
            ?? Brand::factory()->create(['type' => $brandType]);

        $isHp = $brandType === 'hp';
        $name = $this->makeProductName($brand->name, $brand->slug, $isHp);

        return [
            'brand_id' => $brand->id,
            'name' => $name,
            'price' => $this->faker->numberBetween(50000, 15000000),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->randomElement($this->defaultImages()),
            'description' => $this->faker->paragraph(),
            'ram' => $isHp ? $this->faker->randomElement(['4GB', '8GB', '12GB', '16GB']) : null,
            'storage' => $isHp ? $this->faker->randomElement(['64GB', '128GB', '256GB', '512GB']) : null,
            'battery' => $isHp ? $this->faker->randomElement(['4000mAh', '4500mAh', '5000mAh']) : null,
        ];
    }

    private function defaultImages(): array
    {
        return [
            'images/products/infinix30.jpg',
            'images/products/iphone15.jpg',
            'images/products/reno12.jpg',
            'images/products/s24.jpg',
            'images/products/vivov30.jpg',
        ];
    }

    private function makeProductName(string $brandName, string $brandSlug, bool $isHp): string
    {
        $normalizedBrand = trim($brandName);
        $normalizedSlug = strtolower($brandSlug);

        if ($isHp) {
            return match ($normalizedSlug) {
                'apple' => $normalizedBrand . ' iPhone ' . $this->faker->randomElement(['13', '14', '15', '16']) . ' ' . $this->faker->randomElement(['Pro', 'Pro Max', 'Plus', 'Mini']),
                'samsung' => $normalizedBrand . ' Galaxy ' . $this->faker->randomElement(['A15', 'A25', 'S23', 'S24', 'Z Flip5']),
                'xiaomi' => $normalizedBrand . ' Redmi ' . $this->faker->randomElement(['Note 13', '14C', '13 Pro', 'A3']),
                'lenovo' => $normalizedBrand . ' Legion Phone ' . $this->faker->randomElement(['1', '2', '3', 'Pro']),
                default => $normalizedBrand . ' Smartphone ' . $this->faker->bothify('##-?'),
            };
        }

        return match ($normalizedSlug) {
            'anker' => $normalizedBrand . ' Charger ' . $this->faker->randomElement(['20W', '30W', '65W', '100W']),
            'ugreen' => $normalizedBrand . ' Cable ' . $this->faker->randomElement(['USB-C', 'Lightning', 'HDMI', '3A']),
            default => $normalizedBrand . ' Accessory ' . $this->faker->bothify('##-?'),
        };
    }
}