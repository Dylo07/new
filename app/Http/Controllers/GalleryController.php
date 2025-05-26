<?php
// app/Http/Controllers/GalleryController.php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display the general gallery page.
     */
    public function index()
    {
        // Get images from all three categories
        $roomImages = GalleryImage::where('gallery_type', 'room')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $outdoorImages = GalleryImage::where('gallery_type', 'outdoor')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $weddingImages = GalleryImage::where('gallery_type', 'wedding')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.index', compact('roomImages', 'outdoorImages', 'weddingImages'));
    }

    /**
     * Display the room gallery.
     */
    public function rooms()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'room')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.rooms', compact('galleryImages'));
    }

    /**
     * Display the outdoor gallery.
     */
    public function outdoor()
{
    $galleryImages = GalleryImage::where('gallery_type', 'outdoor')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Debug info
    if (count($galleryImages) === 0) {
        // Check if any images exist at all
        $allImages = GalleryImage::all();
        dd([
            'outdoor_images' => $galleryImages,
            'all_images' => $allImages,
            'outdoor_count' => GalleryImage::where('gallery_type', 'outdoor')->count(),
            'all_count' => GalleryImage::count()
        ]);
    }

    return view('gallery.outdoor', compact('galleryImages'));
}

    /**
     * Display the weddings gallery.
     */
    public function weddings()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'wedding')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.weddings', compact('galleryImages'));
    }
}
