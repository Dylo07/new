<?php
// app/Http/Controllers/Admin/GalleryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries.
     */
    public function index()
    {
        $roomImagesCount = GalleryImage::where('gallery_type', 'room')->count();
        $familyCottageImagesCount = GalleryImage::where('gallery_type', 'family_cottage')->count();
        $coupleCottageImagesCount = GalleryImage::where('gallery_type', 'couple_cottage')->count();
        $familyRoomImagesCount = GalleryImage::where('gallery_type', 'family_room')->count();
        $outdoorImagesCount = GalleryImage::where('gallery_type', 'outdoor')->count();
        $weddingImagesCount = GalleryImage::where('gallery_type', 'wedding')->count();
        
        // New categories
        $conferenceHallImagesCount = GalleryImage::where('gallery_type', 'conference_hall')->count();
        $eventImagesCount = GalleryImage::where('gallery_type', 'event')->count();
        $indoorGameImagesCount = GalleryImage::where('gallery_type', 'indoor_game')->count();
        $outdoorGameImagesCount = GalleryImage::where('gallery_type', 'outdoor_game')->count();
        $swimmingPoolImagesCount = GalleryImage::where('gallery_type', 'swimming_pool')->count();
        $diningAreaImagesCount = GalleryImage::where('gallery_type', 'dining_area')->count();

        return view('admin.gallery.index', compact(
            'roomImagesCount', 
            'familyCottageImagesCount', 
            'coupleCottageImagesCount', 
            'familyRoomImagesCount', 
            'outdoorImagesCount', 
            'weddingImagesCount',
            'conferenceHallImagesCount',
            'eventImagesCount',
            'indoorGameImagesCount',
            'outdoorGameImagesCount',
            'swimmingPoolImagesCount',
            'diningAreaImagesCount'
        ));
    }

    /**
     * Display room gallery images.
     */
    public function rooms()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'room')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.gallery.rooms', compact('galleryImages'));
    }

    /**
     * Display family cottages gallery images.
     */
    public function familyCottages()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'family_cottage')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.gallery.family-cottages', compact('galleryImages'));
    }

    /**
     * Display couple cottages gallery images.
     */
    public function coupleCottages()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'couple_cottage')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.gallery.couple-cottages', compact('galleryImages'));
    }

    /**
     * Display family rooms gallery images.
     */
    public function familyRooms()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'family_room')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.gallery.family-rooms', compact('galleryImages'));
    }

    /**
     * Display outdoor gallery images.
     */
    public function outdoor()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'outdoor')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.gallery.outdoor', compact('galleryImages'));
    }

    /**
     * Display wedding gallery images.
     */
    public function weddings()
    {
        $galleryImages = GalleryImage::where('gallery_type', 'wedding')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.gallery.weddings', compact('galleryImages'));
    }


/**
 * Display conference hall gallery images.
 */
public function conferenceHall()
{
    $galleryImages = GalleryImage::where('gallery_type', 'conference_hall')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.gallery.conference-hall', compact('galleryImages'));  // ✅ Matches file name
}

/**
 * Display event gallery images.
 */
public function events()
{
    $galleryImages = GalleryImage::where('gallery_type', 'event')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.gallery.event', compact('galleryImages'));  // ✅ Changed from 'events' to 'event'
}

/**
 * Display indoor game area gallery images.
 */
public function indoorGames()
{
    $galleryImages = GalleryImage::where('gallery_type', 'indoor_game')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.gallery.indoor-game', compact('galleryImages'));  // ✅ Changed from 'indoor-games' to 'indoor-game'
}

/**
 * Display outdoor game area gallery images.
 */
public function outdoorGames()
{
    $galleryImages = GalleryImage::where('gallery_type', 'outdoor_game')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.gallery.outdoor-game', compact('galleryImages'));  // ✅ Changed from 'outdoor-games' to 'outdoor-game'
}

/**
 * Display swimming pool gallery images.
 */
public function swimmingPool()
{
    $galleryImages = GalleryImage::where('gallery_type', 'swimming_pool')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.gallery.swimming-pool', compact('galleryImages'));  // ✅ Matches file name
}

/**
 * Display dining area gallery images.
 */
public function diningArea()
{
    $galleryImages = GalleryImage::where('gallery_type', 'dining_area')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.gallery.dining-area', compact('galleryImages'));  // ✅ Matches file name
}



    /**
     * Upload images to gallery.
     * FIXED VERSION - Uses proper directory structure
     */
    public function upload(Request $request)
{
    $request->validate([
        'gallery_type' => 'required|in:room,family_cottage,couple_cottage,family_room,outdoor,wedding,conference_hall,event,indoor_game,outdoor_game,swimming_pool,dining_area',
        'images' => 'required|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        'title' => 'nullable|string|max:255',
    ]);

    $galleryType = $request->gallery_type;
    $title = $request->title;
    $uploadedCount = 0;

    // Map gallery types to directory names - SAME STRUCTURE AS WORKING CATEGORIES
    $directoryMap = [
        'room' => 'rooms',
        'family_cottage' => 'rooms/familycottage',
        'couple_cottage' => 'rooms/couplecottage',
        'family_room' => 'rooms/familyroom',
        'outdoor' => 'outdoor',                    // ✅ Working structure
        'wedding' => 'wedding',                    // ✅ Working structure
        // New categories - SAME pattern as outdoor/wedding
        'conference_hall' => 'conference-hall',    // ✅ Fixed
        'event' => 'event',                        // ✅ Fixed
        'indoor_game' => 'indoor-games',           // ✅ Fixed
        'outdoor_game' => 'outdoor-games',         // ✅ Fixed
        'swimming_pool' => 'swimming-pool',        // ✅ Fixed
        'dining_area' => 'dining-area'             // ✅ Fixed
    ];

    $directory = $directoryMap[$galleryType];

    // Create directory if it doesn't exist - SAME as working categories
    $uploadDir = public_path('storage/gallery/' . $directory);
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    foreach ($request->file('images') as $image) {
        // Generate a unique filename
        $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
        
        // Move the uploaded file to public/storage directly
        $image->move(public_path('storage/gallery/' . $directory), $filename);
        
        // Store the relative path in the database
        $path = 'gallery/' . $directory . '/' . $filename;
        
        GalleryImage::create([
            'title' => $title ?: $image->getClientOriginalName(),
            'image_path' => $path,
            'gallery_type' => $galleryType,
            'sort_order' => 0,
        ]);

        $uploadedCount++;
    }

    return redirect()->back()->with('success', $uploadedCount . ' image(s) uploaded successfully.');
}






    /**
     * Delete an image from gallery.
     */
    public function delete($id)
    {
        $image = GalleryImage::findOrFail($id);
        
        // Delete the file
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        // Delete the record
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    /**
     * Update image sort order (AJAX).
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|integer|exists:gallery_images,id',
        ]);

        $orders = $request->input('images');
        
        foreach ($orders as $index => $id) {
            GalleryImage::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}