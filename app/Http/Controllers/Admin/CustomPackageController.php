<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'child_price' => 'required|numeric|min:0',
            'min_adults' => 'required|integer|min:1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store in the same path structure as gallery images
                $path = $image->store('gallery-images/custom-packages', 'public');
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
            'child_price' => 'required|numeric|min:0',
            'min_adults' => 'required|integer|min:1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $images = $customPackage->images ?? [];
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store in the same path structure as gallery images
                $path = $image->store('gallery-images/custom-packages', 'public');
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
        // Delete associated images
        if ($customPackage->images) {
            foreach ($customPackage->images as $image) {
                Storage::disk('public')->delete($image);
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
            Storage::disk('public')->delete($images[$imageIndex]);
            unset($images[$imageIndex]);
            $images = array_values($images); // Re-index array

            $customPackage->update(['images' => $images]);
        }

        return response()->json(['success' => true]);
    }
}