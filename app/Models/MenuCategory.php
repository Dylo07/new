<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'features',
        'image_path',
        'menu_image_path',
        'icon',
        'color',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered categories
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get all menu images for this category
     */
    public function menuImages()
    {
        return $this->hasMany(MenuImage::class)->orderBy('sort_order');
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
