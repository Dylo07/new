<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::all();
        $check_in = $request->query('check_in');
        $check_out = $request->query('check_out');
        $adults = $request->query('adults');
        $children = $request->query('children');
    
        if ($check_in && $check_out) {
            foreach ($rooms as $room) {
                // Check if any selected date is in unavailable_dates array
                $unavailable_dates = $room->unavailable_dates ?? [];
                $current_date = Carbon::parse($check_in);
                $end_date = Carbon::parse($check_out);
                
                $is_unavailable = false;
                while ($current_date->lte($end_date)) {
                    if (in_array($current_date->format('Y-m-d'), $unavailable_dates)) {
                        $is_unavailable = true;
                        break;
                    }
                    $current_date->addDay();
                }
                
                // Add dynamic property to room object
                $room->is_available_for_dates = !$is_unavailable;
            }
        }
    
        return view('rooms.index', compact('rooms', 'check_in', 'check_out', 'adults', 'children'));
    }

    public function show(Room $room)
    {
        // Fetch all rooms to pass to the view for similar rooms
        $rooms = Room::all();
    
        return view('rooms.show', compact('room', 'rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms',
            'type' => 'required',
            'category' => 'required|in:ac,ac-balcony,couple,family-cottage,family-ac',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_available' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('room-images', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['is_available'] = $request->has('is_available');
        $validated['unavailable_dates'] = [];

        Room::create($validated);

        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
{
    
    $request->validate([
        'room_number' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'category' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_available' => 'sometimes|boolean',
    ]);

    $room->room_number = $request->room_number;
    $room->type = $request->type;
    $room->category = $request->category;
    $room->description = $request->description;
    $room->price = $request->price;
    $room->is_available = $request->is_available ?? false;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('room-images', 'public');
        $room->image = $imagePath;
    }

    $room->save();

    return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
}


    public function destroy(Room $room)
    {
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }
        
        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }

    public function updateAvailability(Request $request, Room $room)
{
    $validated = $request->validate([
        'date' => 'required|date',
        'action' => 'required|in:toggle'
    ]);

    $unavailableDates = $room->unavailable_dates ?? [];
    $date = $validated['date'];

    if (in_array($date, $unavailableDates)) {
        // Make available by removing date
        $unavailableDates = array_diff($unavailableDates, [$date]);
    } else {
        // Make unavailable by adding date
        $unavailableDates[] = $date;
    }

    $room->update([
        'unavailable_dates' => array_values($unavailableDates)
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Room availability updated successfully',
        'room' => $room->fresh() // Return fresh instance with updated data
    ]);
}

    public function getRoomAvailability(Room $room)
    {
        return response()->json([
            'is_available' => $room->is_available,
            'unavailable_dates' => $room->unavailable_dates
        ]);
    }
   
public function __construct()
{
    // Add middleware to check admin status
    $this->middleware('admin')->except(['index', 'show']);
}
}