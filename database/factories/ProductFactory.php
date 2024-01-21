<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Ref' => $this->faker->unique()->randomNumber,
            'Name' => $this->faker->name,
            'Description' => $this->faker->paragraph,
            'Image_Product' => $this->faker->imageUrl(640, 480),
            'Price_Purchase' => $this->faker->numberBetween(100, 1000),
            'Price_First' => $this->faker->numberBetween(100, 1000),
            'Price_Sale' => $this->faker->numberBetween(100, 1000),
            'Quantity' => $this->faker->numberBetween(100, 1000),
            'Sales' => $this->faker->numberBetween(100, 1000),
            'provider_id'=>Provider::factory()
        ];
    }
}
