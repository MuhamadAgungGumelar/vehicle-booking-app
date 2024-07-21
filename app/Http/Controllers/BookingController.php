<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Approval;
use App\Models\Log;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    public function bookingPage() {
        $bookings = Booking::with(['employee', 'vehicle', 'driver', 'manager'])->get();

        // Create a log record
        Log::create([
            'timestamp' => Carbon::now(),
            'action' => 'Booking accessed by ' . auth()->user()->name,
            'user_id' => auth()->id(),  // Ambil ID pengguna yang sedang login
        ]);

        return view('booking', compact('bookings'));
    }

    public function bookingForm() {
        $employees = User::where('role', 'employee')->get();
        $vehicles = Vehicle::all();
        $drivers = User::where('role', 'driver')->get();
        $managers = User::where('role', 'manager')->get();
        return view('booking.bookingForm', compact('employees', 'vehicles', 'drivers', 'managers'));
    }

    public function store(Request $request) {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:users,id',
            'manager_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        // Create the booking
        $booking = Booking::create([
            'employee_id' => $request->employee_id,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'manager_id' => $request->manager_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'approval_status' => 'pending',
        ]);
        
        Alert::success('Booking Created', 'Booking created successfully.');

        // Create an approval record
        Approval::create([
            'booking_id' => $booking->id,
            'approver_id' => $request->manager_id,
            'status' => $booking->approval_status,
            'level' => 1, 
        ]);
        

        // Get the name of the employee
        $employee = User::find($request->employee_id);

        // Create a log record
        Log::create([
            'timestamp' => Carbon::now(),
            'action' => 'Booking created by Admin for ' . $employee->name,
            'user_id' => auth()->id(),  // Ambil ID pengguna yang sedang login
        ]);


        return redirect()->route('booking')->with('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Booking created successfully.'
        ]);
    }

    public function export()
    {
        // Create a log record
        Log::create([
            'timestamp' => Carbon::now(),
            'action' => 'Booking exported to excel by ' . auth()->user()->name,
            'user_id' => auth()->id(),  // Ambil ID pengguna yang sedang login
        ]);

        return Excel::download(new BookingsExport, 'bookings.xlsx');
    }
}

