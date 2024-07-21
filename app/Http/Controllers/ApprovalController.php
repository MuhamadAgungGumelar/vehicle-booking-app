<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\User;
use App\Models\Log;
use App\Models\Booking;
use Carbon\Carbon;

class ApprovalController extends Controller
{
    public function approvalPage()
    {
        $user = auth()->user();

        // Create a log record
        Log::create([
            'timestamp' => Carbon::now(),
            'action' => 'Approval accessed by ' . $user->name,
            'user_id' => $user->id,
        ]);
        
        // Jika role admin, ambil semua approvals
        if ($user->role === 'admin') {
            $approvals = Approval::with('booking', 'approver')->get();
        } else {
            // Jika role manager, ambil approvals yang dikelola oleh manager tersebut
            $approvals = Approval::where('approver_id', $user->id)
                                ->with('booking', 'approver')
                                ->get();
        }

        return view('approval', compact('approvals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);
    
        $approval = Approval::findOrFail($id);
        $booking = Booking::findOrFail($approval->booking_id);
    
        // Cek jika user admin atau manager yang memiliki akses
        if (auth()->user()->role !== 'admin' && auth()->user()->id !== $approval->approver_id) {
            return redirect()->route('approval')->with('error', 'Unauthorized');
        }
    
        // Update status di tabel approvals
        $approval->status = $request->status;
        $approval->save();
    
        // Update status di tabel bookings
        $booking->approval_status = $request->status;
        $booking->save();
    
        // Get the employee name from the booking associated with this approval
        $employee = User::find($approval->booking->employee_id);
        $approver = auth()->user();
    
        // Create a log record
        Log::create([
            'timestamp' => Carbon::now(),
            'action' => 'Approval status updated by ' . $approver->name . ' for employee ' . $employee->name,
            'user_id' => $approver->id,
        ]);
    
        return redirect()->route('approval')->with('success', 'Approval status updated successfully.');
    }
}
