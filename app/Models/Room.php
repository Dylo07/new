<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'type',
        'category',
        'price',
        'description',
        'is_available',
        'unavailable_dates'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'unavailable_dates' => 'array',
        'price' => 'decimal:2'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
