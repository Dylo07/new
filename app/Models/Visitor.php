<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'country',
        'country_code',
        'city',
        'url',
        'page_name',
        'device_type',
        'browser',
        'platform',
        'referrer',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
