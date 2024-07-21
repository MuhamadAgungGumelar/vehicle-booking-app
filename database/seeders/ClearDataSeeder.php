<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Approval;
use App\Models\Log;

class ClearDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::truncate();
        User::truncate();
        Booking::truncate();
        Approval::truncate();
        Log::truncate();
    }
}
