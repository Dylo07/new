<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    public function index()
    {
        // Generate 6 months of calendar data
        $months = [];
        for ($i = 0; $i < 6; $i++) {
            $month = Carbon::now()->addMonths($i);
            $months[] = [
                'month' => $month,
                'availability' => $this->getMonthAvailability($month),
            ];
        }
        
        return view('calendar.index', compact('months'));
    }

    



    public function admin()
    {
        $currentMonth = Carbon::now();
        $nextMonth = Carbon::now()->addMonth();
        
        $currentMonthAvailability = $this->getMonthAvailability($currentMonth);
        $nextMonthAvailability = $this->getMonthAvailability($nextMonth);
        
        return view('calendar.admin', compact('currentMonth', 'nextMonth', 'currentMonthAvailability', 'nextMonthAvailability'));
    }
    
    public function edit()
    {
        $currentMonth = Carbon::now();
        $nextMonth = Carbon::now()->addMonth();
        
        $currentMonthAvailability = $this->getMonthAvailability($currentMonth);
        $nextMonthAvailability = $this->getMonthAvailability($nextMonth);
        
        return view('calendar.edit', compact('currentMonth', 'nextMonth', 'currentMonthAvailability', 'nextMonthAvailability'));
    }
    
    public function update(Request $request)
    {
        try {
            $data = $request->json()->all();
            
            $validator = Validator::make($data, [
                'date' => 'required|date',
                'status' => 'required|in:available,limited,booked',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            $validated = $validator->validated();
            
            Availability::updateOrCreate(
                ['date' => $validated['date']],
                ['status' => $validated['status']]
            );
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error updating availability: ' . $e->getMessage()
            ], 500);
        }
    }
    
     // Add this method to get availability data (same as in CalendarController)
     /**
     * Get availability data with booking details for a month
     */
    private function getMonthAvailability(Carbon $month)
    {
        $startOfMonth = $month->copy()->startOfMonth();
        $endOfMonth = $month->copy()->endOfMonth();
        
        // Get all availability records for this month with all details
        $availabilityRecords = Availability::whereBetween('date', [
            $startOfMonth->format('Y-m-d'), 
            $endOfMonth->format('Y-m-d')
        ])->get();
        
        // Create a map with date string as key
        $dateDataMap = [];
        foreach ($availabilityRecords as $record) {
            $dateKey = $record->date instanceof \Carbon\Carbon 
                ? $record->date->format('Y-m-d') 
                : date('Y-m-d', strtotime($record->date));
            
            $dateDataMap[$dateKey] = [
                'status' => $record->status,
                'rooms' => $record->rooms ?? [],
                'function_type' => $record->function_type,
                'guest_count' => $record->guest_count,
            ];
        }
        
        // Build availability array
        $availability = [];
        $currentDate = $startOfMonth->copy();
        
        while ($currentDate <= $endOfMonth) {
            $dateString = $currentDate->format('Y-m-d');
            $availability[$dateString] = $dateDataMap[$dateString] ?? [
                'status' => 'available',
                'rooms' => [],
                'function_type' => null,
                'guest_count' => null,
            ];
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