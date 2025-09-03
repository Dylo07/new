<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'type',
        'sub_type',
        'description',
        'menu',
        'adult_price',
        'child_price',
        'min_adults',
        'is_active',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
        'adult_price' => 'decimal:2',
        'child_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Scope for active packages
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for specific category
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope for specific type
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Get formatted price
    public function getFormattedAdultPriceAttribute()
    {
        return 'Rs ' . number_format($this->adult_price, 0);
    }

    public function getFormattedChildPriceAttribute()
    {
        return 'Rs ' . number_format($this->child_price, 0);
    }

    // Calculate total price
    public function calculateTotal($adults, $children = 0)
    {
        return ($this->adult_price * $adults) + ($this->child_price * $children);
    }

    // Check if package is available for given adult count
    public function isAvailableFor($adults)
    {
        return $adults >= $this->min_adults;
    }
}