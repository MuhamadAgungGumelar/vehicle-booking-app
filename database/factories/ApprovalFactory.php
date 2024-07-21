<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approvals>
 */
class ApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->first()->id,
            'approver_id' => User::whereIn('role', ['manager', 'admin'])->inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'level' => $this->faker->numberBetween(1, 2),
        ];
    }
}
