<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Booking::with(['employee', 'vehicle', 'driver', 'manager'])
                      ->get()
                      ->map(function ($booking) {
                          return [
                              'id' => $booking->id,
                              'employee' => $booking->employee->name,
                              'vehicle' => $booking->vehicle->type,
                              'driver' => $booking->driver->name,
                              'manager' => $booking->manager->name,
                              'start_time' => $booking->start_time,
                              'end_time' => $booking->end_time,
                              'status' => $booking->approval_status,
                          ];
                      });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Employee',
            'Vehicle',
            'Driver',
            'Manager',
            'Start Time',
            'End Time',
            'Status',
        ];
    }
}
