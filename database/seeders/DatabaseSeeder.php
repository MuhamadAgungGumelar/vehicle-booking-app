<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        // User::factory()->withPersonalTeam()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Menambahkan data dummy
        \App\Models\User::factory(10)->create();
        \App\Models\Vehicle::factory(10)->create();
        \App\Models\Booking::factory(10)->create();
        \App\Models\Approval::factory(10)->create();
        \App\Models\Log::factory(10)->create();
    }
}
