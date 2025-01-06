<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // You can fetch gallery images from database if needed
        $images = [
            [
                'id' => 1,
                'title' => 'Hotel Front View',
                'image' => 'gallery/hotel-front.jpg',
                'category' => 'exterior'
            ],
            [
                'id' => 2,
                'title' => 'Deluxe Room',
                'image' => 'gallery/deluxe-room.jpg',
                'category' => 'rooms'
            ],
            // Add more images as needed
        ];

        return view('gallery.index', compact('images'));
    }
}
