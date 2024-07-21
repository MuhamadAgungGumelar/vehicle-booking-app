<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ApprovalController::class)->group(function(){
    Route::get('/approval', 'approvalPage')->name('approval');
    Route::post('/approval/{id}/update-status', 'updateStatus')->name('updateStatus');
});

Route::controller(BookingController::class)->group(function(){
    Route::get('/booking', "bookingPage")->name("booking");
    Route::get('/booking/form', "bookingForm")->name("bookingForm");
    Route::post('/booking', "store")->name("booking.store");
    Route::get('/booking/export', 'export')->name('booking.export');
});

Route::controller(LogController::class)->group(function(){
    Route::get('/log', "logPage")->name("log");
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});
