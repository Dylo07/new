<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_category_id',
        'image_path',
        'title',
        'sort_order',
    ];

    /**
     * Get the menu category that owns this image
     */
    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class);
    }

    /**
     * Scope to order by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
