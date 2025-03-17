<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Availability;
use Illuminate\Http\Request;
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
        
        return view('home', compact('backgroundImage', 'currentMonth', 'currentMonthAvailability'));
    }
    
    // Add the getMonthAvailability method from CalendarController
    private function getMonthAvailability(Carbon $month)
    {
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