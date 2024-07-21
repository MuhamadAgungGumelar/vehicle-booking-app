<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['person_transport', 'goods_transport']),
            'owned_by_company' => $this->faker->boolean,
            'fuel_consumption_rate' => $this->faker->randomFloat(2, 0, 20),
        ];
    }
}
