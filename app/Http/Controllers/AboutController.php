<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $aboutInfo = [
            'description' => 'Welcome to our luxurious hotel, where comfort meets elegance. With years of expertise in hospitality, we strive to provide our guests with unforgettable experiences.',
            'mission' => 'Our mission is to provide exceptional hospitality services that exceed our guests\' expectations while maintaining the highest standards of comfort and luxury.',
            'vision' => 'To be recognized as the leading luxury hotel destination, known for outstanding service, comfort, and memorable experiences.',
            'features' => [
                'Luxurious Accommodations',
                '24/7 Room Service',
                'Fine Dining Restaurant',
                'Spa and Wellness Center',
                'Conference Facilities',
                'Swimming Pool'
            ],
            'team' => [
                [
                    'name' => 'John Doe',
                    'position' => 'General Manager',
                    'image' => 'team/manager.jpg'
                ],
                [
                    'name' => 'Jane Smith',
                    'position' => 'Executive Chef',
                    'image' => 'team/chef.jpg'
                ],
                [
                    'name' => 'Mike Johnson',
                    'position' => 'Customer Relations Manager',
                    'image' => 'team/customer-relations.jpg'
                ]
            ]
        ];

        return view('about.index', compact('aboutInfo'));
    }
}