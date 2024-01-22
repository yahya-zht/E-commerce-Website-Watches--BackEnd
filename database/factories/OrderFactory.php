<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'Telephone' => $this->faker->phoneNumber,
            'Total_Price' => $this->faker->numberBetween,
            'Email' => $this->faker->email,
            'Address' => $this->faker->address,
            'City' => $this->faker->city,
            'Country' => $this->faker->country,
        ];
    }
}
