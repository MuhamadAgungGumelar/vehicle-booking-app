<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Approval;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'vehicle_id',
        'driver_id',
        'manager_id',
        'start_time',
        'end_time',
        'approval_status',
    ];

    public function employee() : BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function vehicle() : BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function driver() : BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function manager() : BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}