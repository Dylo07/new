<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Availability;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // You can set your background image URL here
        $backgroundImage = 'images/hotel-background.jpg';
        
        // Get current month for calendar
        $currentMonth = Carbon::now();
        
        // Get availability data
        $currentMonthAvailability = $this->getMonthAvailability($currentMonth);
        
        // Get gallery images with caching and single query optimization (4 per category)
        $galleryImages = $this->getGalleryImagesOptimized();
        
        return view('home', array_merge([
            'backgroundImage' => $backgroundImage,
            'currentMonth' => $currentMonth,
            'currentMonthAvailability' => $currentMonthAvailability,
        ], $galleryImages));
    }
    
    /**
     * Optimized gallery images fetching with caching and single query (4 images per category)
     */
    private function getGalleryImagesOptimized()
    {
        // Cache for 30 minutes to reduce database load
        return Cache::remember('homepage_gallery_images', 30, function () {
            // Single query to get all needed images
            $allImages = GalleryImage::whereIn('gallery_type', [
                'room', 'family_cottage', 'couple_cottage', 
                'family_room', 'outdoor', 'wedding'
            ])
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();
            
            // Group by type and limit to 4 per category for homepage
            $groupedImages = $allImages->groupBy('gallery_type');
            
            return [
                'roomImages' => $groupedImages->get('room', collect())->take(4),
                'familyCottageImages' => $groupedImages->get('family_cottage', collect())->take(4),
                'coupleCottageImages' => $groupedImages->get('couple_cottage', collect())->take(4),
                'familyRoomImages' => $groupedImages->get('family_room', collect())->take(4),
                'outdoorImages' => $groupedImages->get('outdoor', collect())->take(4),
                'weddingImages' => $groupedImages->get('wedding', collect())->take(4),
            ];
        });
    }
    
    // Add the getMonthAvailability method from CalendarController
    private function getMonthAvailability(Carbon $month)
    {
        // Cache availability for 1 hour
        $cacheKey = 'availability_' . $month->format('Y-m');
        
        return Cache::remember($cacheKey, 60, function () use ($month) {
            $startOfMonth = $month->copy()->startOfMonth();
            $endOfMonth = $month->copy()->endOfMonth();
            
            // Get all availability records for this month
            $availabilityRecords = Availability::whereBetween('date', [
                $startOfMonth->format('Y-m-d'), 
                $endOfMonth->format('Y-m-d')
            ])->get();
            
            // Create a map with date string as key (for easier lookup)
            $dateStatusMap = [];
            foreach ($availabilityRecords as $record) {
                // Format the date as a string to ensure consistent comparison
                $dateKey = $record->date instanceof \Carbon\Carbon 
                    ? $record->date->format('Y-m-d') 
                    : date('Y-m-d', strtotime($record->date));
                $dateStatusMap[$dateKey] = $record->status;
            }
            
            // Build availability array
            $availability = [];
            $currentDate = $startOfMonth->copy();
            
            while ($currentDate <= $endOfMonth) {
                $dateString = $currentDate->format('Y-m-d');
                $availability[$dateString] = $dateStatusMap[$dateString] ?? 'available';
                $currentDate->addDay();
            }
            
            return $availability;
        });
    }
    
    public function search(Request $request)
    {
        $validated = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
        ]);
        
        // Add your search logic here
        return redirect()->route('rooms.index', $validated);
    }
}