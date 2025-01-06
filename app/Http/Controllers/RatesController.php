<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;

class RatesController extends Controller
{
    public function index()
    {
        // You can fetch rates from database if needed
        $packages = [
            [
                'name' => 'Standard Room',
                'price' => 100,
                'description' => 'Perfect for solo travelers or couples',
                'features' => [
                    'Free WiFi',
                    'Breakfast Included',
                    'Air Conditioning',
                    'LCD TV'
                ],
                'image' => 'rooms/standard.jpg'
            ],
            [
                'name' => 'Deluxe Room',
                'price' => 150,
                'description' => 'Spacious room with premium amenities',
                'features' => [
                    'Free WiFi',
                    'Breakfast Included',
                    'Mini Bar',
                    'Ocean View',
                    'Room Service'
                ],
                'image' => 'rooms/deluxe.jpg'
            ],
            [
                'name' => 'Suite',
                'price' => 250,
                'description' => 'Luxury suite with separate living area',
                'features' => [
                    'Free WiFi',
                    'Breakfast & Dinner',
                    'Mini Bar',
                    'Ocean View',
                    'Room Service',
                    'Private Balcony'
                ],
                'image' => 'rooms/suite.jpg'
            ],
        ];

        return view('rates.index', compact('packages'));
    }
}