<?php
// app/Models/GalleryImage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'gallery_type', // 'room', 'outdoor', 'wedding', 'family_cottage', 'couple_cottage', 'family_room'
        'sort_order',
    ];

    /**
     * Get all available gallery types
     */
    public static function getGalleryTypes()
    {
        return [
            'room' => 'General Rooms',
            'family_cottage' => 'Family Cottages',
            'couple_cottage' => 'Couple Cottages', 
            'family_room' => 'Family Rooms',
            'outdoor' => 'Outdoor',
            'wedding' => 'Weddings'
        ];
    }

    /**
     * Get the display name for a gallery type
     */
    public function getGalleryTypeDisplayAttribute()
    {
        $types = self::getGalleryTypes();
        return $types[$this->gallery_type] ?? ucfirst($this->gallery_type);
    }
}