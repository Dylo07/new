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
        // Get images from all categories
        $roomImages = GalleryImage::where('gallery_type', 'room')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $familyCottageImages = GalleryImage::where('gallery_type', 'family_cottage')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $coupleCottageImages = GalleryImage::where('gallery_type', 'couple_cottage')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $familyRoomImages = GalleryImage::where('gallery_type', 'family_room')
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

        return view('gallery.index', compact(
            'roomImages', 
            'familyCottageImages', 
            'coupleCottageImages', 
            'familyRoomImages', 
            'outdoorImages', 
            'weddingImages'
        ));
    }

    /**
     * Display the general room gallery.
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
     * Display the family cottages gallery.
     */
    public function familyCottages()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'family_cottage')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.family-cottages', compact('galleryImages'));
    }

    /**
     * Display the couple cottages gallery.
     */
    public function coupleCottages()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'couple_cottage')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.couple-cottages', compact('galleryImages'));
    }

    /**
     * Display the family rooms gallery.
     */
    public function familyRooms()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'family_room')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.family-rooms', compact('galleryImages'));
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