<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class RatesController extends Controller
{
    public function index()
    {
        // Fetch all active packages ordered by sort_order and created_at
        $allPackages = Package::active()->ordered()->get();
        
        // Group packages by type for better organization
        $packagesByType = [
            'couple' => $allPackages->where('type', 'couple'),
            'family' => $allPackages->where('type', 'family'),
            'group' => $allPackages->where('type', 'group'),
            'wedding' => $allPackages->where('type', 'wedding'),
            'engagement' => $allPackages->where('type', 'engagement'),
            'birthday' => $allPackages->where('type', 'birthday'),
            'honeymoon' => $allPackages->where('type', 'honeymoon'),
        ];
        
        // Package type information for display
        $packageTypeInfo = [
            'couple' => [
                'title' => 'Couple Packages',
                'subtitle' => 'For Couples',
                'description' => 'Indulge in our exclusive couple packages featuring cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games for a perfect romantic getaway.',
                'color' => 'pink'
            ],
            'family' => [
                'title' => 'Family Packages', 
                'subtitle' => 'For Families (2 to 10 Guests)',
                'description' => 'Enjoy our family packages with cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games, perfect for groups of 2 to 10 guests.',
                'color' => 'purple'
            ],
            'group' => [
                'title' => 'Group Packages',
                'subtitle' => 'Suitable for Offices, Large Families, and Groups (10+ Guests)', 
                'description' => 'Experience our group packages with cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games, perfect for groups of more than 10 guests.',
                'color' => 'green'
            ],
            'wedding' => [
                'title' => 'Wedding Packages',
                'subtitle' => 'Experience Unmatched Elegance',
                'description' => 'Celebrate your special day in unparalleled style and sophistication with our exclusive luxury wedding packages. Our meticulously curated offerings include opulent accommodations, gourmet dining experiences, and access to our stunning swimming pool and other premium amenities.',
                'color' => 'purple'
            ],
            'engagement' => [
                'title' => 'Engagement Packages',
                'subtitle' => 'Celebrate Your Love Story',
                'description' => 'Mark the beginning of your journey together with our romantic engagement packages. Featuring intimate settings, beautiful decorations, photography opportunities, and memorable experiences perfect for your special moment.',
                'color' => 'pink'
            ],
            'birthday' => [
                'title' => 'Birthday Packages',
                'subtitle' => 'Make Every Birthday Special',
                'description' => 'Celebrate another year of life with our exciting birthday packages. From intimate family gatherings to grand celebrations, we offer customized experiences with decorations, entertainment, and delicious treats.',
                'color' => 'yellow'
            ],
            'honeymoon' => [
                'title' => 'Honeymoon Packages',
                'subtitle' => 'Your Perfect Romantic Escape',
                'description' => 'Begin your married life with an unforgettable honeymoon experience. Our romantic packages include luxurious accommodations, couples spa treatments, candlelit dinners, and intimate settings for the perfect romantic getaway.',
                'color' => 'red'
            ]
        ];

        return view('rates.index', compact('packagesByType', 'packageTypeInfo', 'allPackages'));
    }
}