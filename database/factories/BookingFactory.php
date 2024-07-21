<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Menentukan bulan-bulan yang ingin digunakan untuk data dummy
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        // Menghasilkan bulan acak dari array bulan yang sudah ditentukan
        $month = $this->faker->randomElement($months);
        
        // Menggunakan tahun saat ini
        $year = date('Y');
        
        // Menghasilkan tanggal acak di bulan dan tahun yang telah ditentukan
        $startDay = $this->faker->numberBetween(1, 28); // Menggunakan 28 untuk menghindari tanggal yang tidak valid
        $startDate = \DateTime::createFromFormat('Y-m-d', "$year-$month-$startDay");
        
        // Menetapkan rentang waktu untuk tanggal akhir
        $endDate = \DateTime::createFromFormat('Y-m-d', "$year-$month-" . $this->faker->numberBetween($startDay + 1, 28));

        // Menghasilkan tanggal mulai dan akhir untuk booking
        $startTime = $this->faker->dateTimeBetween($startDate, $endDate);
        $endTime = $this->faker->dateTimeBetween($startTime, $endDate->modify('+1 week'));
        
        return [
            'employee_id' => User::where('role', 'employee')->inRandomOrder()->first()->id,
            'vehicle_id' => Vehicle::inRandomOrder()->first()->id,
            'driver_id' => User::where('role', 'driver')->inRandomOrder()->first()->id,
            'manager_id' => User::where('role', 'manager')->inRandomOrder()->first()->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'approval_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
