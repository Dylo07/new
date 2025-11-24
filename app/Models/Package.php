<?php
// app/Models/Package.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'features',
        'price',
        'currency',
        'duration',
        'location',
        'image_path',
        'additional_info',
        'min_guests',
        'max_guests',
        'pricing_tiers',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'additional_info' => 'array',
        'pricing_tiers' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0) . ' ' . $this->currency;
    }

    public function getWhatsappUrlAttribute()
    {
        return 'https://wa.me/94717152955?text=' . urlencode("I'm interested in the {$this->name} package. Could you provide more details?");
    }

    // Methods
    public static function getPackageTypes()
    {
        return [
            'couple' => 'Couple Packages',
            'family' => 'Family Packages', 
            'group' => 'Group Packages',
            'wedding' => 'Wedding Packages',
            'engagement' => 'Engagement Packages',
            'birthday' => 'Birthday Packages',
            'honeymoon' => 'Honeymoon Packages'
        ];
    }

    public function getTypeDisplayName()
    {
        $types = self::getPackageTypes();
        return $types[$this->type] ?? ucfirst($this->type);
    }
}