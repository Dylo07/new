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
        $outdoorImagesCount = GalleryImage::where('gallery_type', 'outdoor')->count();
        $weddingImagesCount = GalleryImage::where('gallery_type', 'wedding')->count();

        return view('admin.gallery.index', compact('roomImagesCount', 'outdoorImagesCount', 'weddingImagesCount'));
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
            'gallery_type' => 'required|in:room,outdoor,wedding',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'title' => 'nullable|string|max:255',
        ]);

        $galleryType = $request->gallery_type;
        $title = $request->title;
        $uploadedCount = 0;

        foreach ($request->file('images') as $image) {
            $path = $image->store('gallery/' . $galleryType, 'public');
            
            GalleryImage::create([
                'title' => $title ?: $image->getClientOriginalName(),
                'image_path' => $path,
                'gallery_type' => $galleryType,
                'sort_order' => 0, // Default sort order
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