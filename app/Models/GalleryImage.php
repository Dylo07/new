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
        'gallery_type', // 'room', 'outdoor', 'wedding'
        'sort_order',
    ];
}