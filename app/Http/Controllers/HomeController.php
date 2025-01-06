<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // You can set your background image URL here
        $backgroundImage = 'images/hotel-background.jpg';
        return view('home', compact('backgroundImage'));
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