<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    private static $number = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Product ' . self::$number++,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'barcode' => $this->faker->unique()->ean13,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
