<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date', 
        'status', 
        'rooms', 
        'function_type', 
        'guest_count',
        'booking_id'
    ];
    
    protected $casts = [
        'date' => 'date',
        'rooms' => 'array',
        'guest_count' => 'integer',
    ];
}