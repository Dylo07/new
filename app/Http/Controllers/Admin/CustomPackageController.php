<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPackage;
use Illuminate\Http\Request;

class CustomPackageController extends Controller
{
    public function index()
    {
        $packages = CustomPackage::orderBy('category')
            ->orderBy('type')
            ->orderBy('sub_type')
            ->paginate(15);

        return view('admin.custom-packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.custom-packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:couple,family,group',
            'type' => 'required|in:day_out,half_board,full_board',
            'sub_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'menu' => 'nullable|string',
            'adult_price' => 'required|numeric|min:0',
            'single_price' => 'nullable|numeric|min:0',
            'child_price' => 'required|numeric|min:0',
            'min_adults' => 'required|integer|min:1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            // Create directory if it doesn't exist (matching your existing pattern)
            $uploadDir = public_path('storage/custom-packages');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                // Generate a unique filename (matching your existing pattern)
                $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                
                // Move the uploaded file to public/storage/custom-packages directly
                $image->move(public_path('storage/custom-packages'), $filename);
                
                // Store the relative path in the database (matching your existing pattern)
                $path = 'custom-packages/' . $filename;
                $images[] = $path;
            }
        }

        CustomPackage::create([
            'name' => $request->name,
            'category' => $request->category,
            'type' => $request->type,
            'sub_type' => $request->sub_type,
            'description' => $request->description,
            'menu' => $request->menu,
            'adult_price' => $request->adult_price,
            'single_price' => $request->single_price,
            'child_price' => $request->child_price,
            'min_adults' => $request->min_adults,
            'is_active' => $request->has('is_active'),
            'images' => $images
        ]);

        return redirect()->route('admin.custom-packages.index')
            ->with('success', 'Custom package created successfully.');
    }

    public function show(CustomPackage $customPackage)
    {
        return view('admin.custom-packages.show', compact('customPackage'));
    }

    public function edit(CustomPackage $customPackage)
    {
        return view('admin.custom-packages.edit', compact('customPackage'));
    }

    public function update(Request $request, CustomPackage $customPackage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:couple,family,group',
            'type' => 'required|in:day_out,half_board,full_board',
            'sub_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'menu' => 'nullable|string',
            'adult_price' => 'required|numeric|min:0',
            'single_price' => 'nullable|numeric|min:0',
            'child_price' => 'required|numeric|min:0',
            'min_adults' => 'required|integer|min:1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $images = $customPackage->images ?? [];
        
        if ($request->hasFile('images')) {
            // Create directory if it doesn't exist
            $uploadDir = public_path('storage/custom-packages');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                // Generate a unique filename
                $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                
                // Move the uploaded file to public/storage/custom-packages directly
                $image->move(public_path('storage/custom-packages'), $filename);
                
                // Store the relative path in the database
                $path = 'custom-packages/' . $filename;
                $images[] = $path;
            }
        }

        $customPackage->update([
            'name' => $request->name,
            'category' => $request->category,
            'type' => $request->type,
            'sub_type' => $request->sub_type,
            'description' => $request->description,
            'menu' => $request->menu,
            'adult_price' => $request->adult_price,
            'single_price' => $request->single_price,
            'child_price' => $request->child_price,
            'min_adults' => $request->min_adults,
            'is_active' => $request->has('is_active'),
            'images' => $images
        ]);

        return redirect()->route('admin.custom-packages.index')
            ->with('success', 'Custom package updated successfully.');
    }

    public function destroy(CustomPackage $customPackage)
    {
        // Delete associated images (matching your existing pattern)
        if ($customPackage->images) {
            foreach ($customPackage->images as $imagePath) {
                $fullPath = public_path('storage/' . $imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $customPackage->delete();

        return redirect()->route('admin.custom-packages.index')
            ->with('success', 'Custom package deleted successfully.');
    }

    public function removeImage(Request $request, CustomPackage $customPackage)
    {
        $imageIndex = $request->image_index;
        $images = $customPackage->images ?? [];

        if (isset($images[$imageIndex])) {
            // Delete the file (matching your existing pattern)
            $imagePath = public_path('storage/' . $images[$imageIndex]);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            unset($images[$imageIndex]);
            $images = array_values($images); // Re-index array

            $customPackage->update(['images' => $images]);
        }

        return response()->json(['success' => true]);
    }
}