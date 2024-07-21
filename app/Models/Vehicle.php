<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Booking;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'owned_by_company',
        'fuel_consumption_rate',
    ];

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class);
    }
}