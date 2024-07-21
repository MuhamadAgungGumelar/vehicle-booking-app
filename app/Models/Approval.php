<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Booking;
use App\Models\User;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'approver_id',
        'status',
        'level',
    ];

    public function booking() : BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function approver() : BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    // Set level based on status
    public function setStatusAttribute($value)
    {
        $statusMap = [
            'pending' => 1,
            'approved' => 2,
            'rejected' => 3,
        ];

        $this->attributes['status'] = $value;
        $this->attributes['level'] = $statusMap[$value] ?? 1; // Default to 1 if status is unknown
    }

    public function getStatusAttribute()
    {
        $statusMap = [
            1 => 'pending',
            2 => 'approved',
            3 => 'rejected',
        ];

        return $statusMap[$this->attributes['level']] ?? 'pending';
    }
}