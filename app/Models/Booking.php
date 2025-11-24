<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'custom_package_id', // <--- Added: Links to the package
        'package_details',   // <--- Added: Stores specific details (adults, kids, etc.)
        'check_in',
        'check_out',
        'guests',
        'status',
        'total_price'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'package_details' => 'array' // <--- Added: Automatically converts the JSON data to an Array
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // New relationship to fetch Package details
    public function customPackage()
    {
        return $this->belongsTo(CustomPackage::class, 'custom_package_id');
    }
}