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

        // New categories
        $conferenceHallImages = GalleryImage::where('gallery_type', 'conference_hall')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $eventImages = GalleryImage::where('gallery_type', 'event')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $indoorGameImages = GalleryImage::where('gallery_type', 'indoor_game')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $outdoorGameImages = GalleryImage::where('gallery_type', 'outdoor_game')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $swimmingPoolImages = GalleryImage::where('gallery_type', 'swimming_pool')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $diningAreaImages = GalleryImage::where('gallery_type', 'dining_area')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.index', compact(
            'roomImages', 
            'familyCottageImages', 
            'coupleCottageImages', 
            'familyRoomImages', 
            'outdoorImages', 
            'weddingImages',
            'conferenceHallImages',
            'eventImages',
            'indoorGameImages',
            'outdoorGameImages',
            'swimmingPoolImages',
            'diningAreaImages'
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

    /**
     * Display the conference hall gallery.
     */
    public function conferenceHall()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'conference_hall')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.conference-hall', compact('galleryImages'));
    }

    /**
     * Display the event gallery.
     */
    public function events()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'event')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.events', compact('galleryImages'));
    }

    /**
     * Display the indoor game area gallery.
     */
    public function indoorGames()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'indoor_game')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.indoor-games', compact('galleryImages'));
    }

    /**
     * Display the outdoor game area gallery.
     */
    public function outdoorGames()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'outdoor_game')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.outdoor-games', compact('galleryImages'));
    }

    /**
     * Display the swimming pool gallery.
     */
    public function swimmingPool()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'swimming_pool')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.swimming-pool', compact('galleryImages'));
    }

    /**
     * Display the dining area gallery.
     */
    public function diningArea()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'dining_area')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.dining-area', compact('galleryImages'));
    }
}