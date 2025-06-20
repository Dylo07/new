<?php
// app/Http/Controllers/Admin/GalleryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.gallery.index', compact(
            'roomImagesCount', 
            'familyCottageImagesCount', 
            'coupleCottageImagesCount', 
            'familyRoomImagesCount', 
            'outdoorImagesCount', 
            'weddingImagesCount'
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
     * Upload images to gallery.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'gallery_type' => 'required|in:room,family_cottage,couple_cottage,family_room,outdoor,wedding',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'title' => 'nullable|string|max:255',
        ]);

        $galleryType = $request->gallery_type;
        $title = $request->title;
        $uploadedCount = 0;

        // Map gallery types to directory names
        $directoryMap = [
            'room' => 'rooms',
            'family_cottage' => 'rooms/familycottage',
            'couple_cottage' => 'rooms/couplecottage',
            'family_room' => 'rooms/familyroom',
            'outdoor' => 'outdoor',
            'wedding' => 'wedding'
        ];

        $directory = $directoryMap[$galleryType];

        // Create directory if it doesn't exist
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