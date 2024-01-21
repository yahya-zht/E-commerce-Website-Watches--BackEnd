<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
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
            'Email' => $this->faker->email,
            'Telephone' => $this->faker->phoneNumber,
            'Address' => $this->faker->address,
            'City' => $this->faker->city,
            'Country' => $this->faker->country,
        ];
    }
}
