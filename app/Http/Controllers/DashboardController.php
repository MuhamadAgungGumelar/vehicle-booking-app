<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Create a log record
        Log::create([
            'timestamp' => Carbon::now(),
            'action' => 'Dashboard accessed by ' . auth()->user()->name,
            'user_id' => auth()->id(),  // Ambil ID pengguna yang sedang login
        ]);

        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $totalVehicles = Vehicle::count();

        // Mendapatkan data booking per bulan
        $bookingsPerMonth = Booking::selectRaw('EXTRACT(MONTH FROM start_time) as month, COUNT(*) as total')
            ->groupBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Mengisi bulan yang tidak ada booking dengan 0
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($bookingsPerMonth[$i])) {
                $bookingsPerMonth[$i] = 0;
            }
        }

        ksort($bookingsPerMonth);

        return view('dashboard', compact('totalBookings', 'totalUsers', 'totalVehicles', 'bookingsPerMonth'));
    }
}
