<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;

class LogController extends Controller
{
    public function logPage()
    {
        // Fetch all logs or use any specific query
        $logs = Log::with('user')->get(); // Fetch logs with associated user data

        // Create a log record
        Log::create([
            'timestamp' => Carbon::now(),
            'action' => 'Log accessed by ' . auth()->user()->name,
            'user_id' => auth()->id(),  // Ambil ID pengguna yang sedang login
        ]);

        return view('log', compact('logs'));
    }
}


