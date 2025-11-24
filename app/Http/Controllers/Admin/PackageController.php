<?php
// app/Http/Controllers/Admin/PackageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;


class PackageController extends Controller
{
    /**
     * Display a listing of packages
     */
    public function index()
    {
        $packages = Package::orderBy('sort_order')->orderBy('created_at')->get();
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new package
     */
    public function create()
    {
        $packageTypes = Package::getPackageTypes();
        return view('admin.packages.create', compact('packageTypes'));
    }

    /**
     * Store a newly created package
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:couple,family,group,wedding,engagement,birthday,honeymoon',
            'description' => 'nullable|string',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'duration' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'min_guests' => 'nullable|integer|min:1',
            'max_guests' => 'nullable|integer|min:1',
            'pricing_tiers' => 'nullable|array',
            'pricing_tiers.*.guests' => 'required_with:pricing_tiers|integer|min:1',
            'pricing_tiers.*.price' => 'required_with:pricing_tiers|numeric|min:0',
            'additional_info' => 'nullable|array',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except(['image']);
        
        // Handle image upload - FIXED VERSION
        if ($request->hasFile('image')) {
            // Create directory if it doesn't exist
            $uploadDir = public_path('storage/packages');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Generate a unique filename
            $image = $request->file('image');
            $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Move the uploaded file to public/storage/packages directly
            $image->move(public_path('storage/packages'), $filename);
            
            // Store the relative path in the database
            $data['image_path'] = 'packages/' . $filename;
        }

        // Filter out empty features
        $data['features'] = array_filter($request->features, function($feature) {
            return !empty(trim($feature));
        });

        // Handle pricing tiers for wedding packages
        if ($request->type === 'wedding' && $request->pricing_tiers) {
            $data['pricing_tiers'] = array_filter($request->pricing_tiers, function($tier) {
                return !empty($tier['guests']) && !empty($tier['price']);
            });
        }

        // Set sort order to the highest + 1 if not provided
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $maxSortOrder = Package::max('sort_order') ?? 0;
            $data['sort_order'] = $maxSortOrder + 1;
        }

        Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package created successfully.');
    }
    /**
     * Display the specified package
     */
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified package
     */
    public function edit(Package $package)
    {
        $packageTypes = Package::getPackageTypes();
        return view('admin.packages.edit', compact('package', 'packageTypes'));
    }

    /**
     * Update the specified package
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:couple,family,group,wedding,engagement,birthday,honeymoon',
            'description' => 'nullable|string',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'duration' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'min_guests' => 'nullable|integer|min:1',
            'max_guests' => 'nullable|integer|min:1',
            'pricing_tiers' => 'nullable|array',
            'pricing_tiers.*.guests' => 'required_with:pricing_tiers|integer|min:1',
            'pricing_tiers.*.price' => 'required_with:pricing_tiers|numeric|min:0',
            'additional_info' => 'nullable|array',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except(['image']);

        // Handle image upload - FIXED VERSION
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($package->image_path) {
                $oldImagePath = public_path('storage/' . $package->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            // Create directory if it doesn't exist
            $uploadDir = public_path('storage/packages');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Generate a unique filename
            $image = $request->file('image');
            $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Move the uploaded file to public/storage/packages directly
            $image->move(public_path('storage/packages'), $filename);
            
            // Store the relative path in the database
            $data['image_path'] = 'packages/' . $filename;
        }

        // Filter out empty features
        $data['features'] = array_filter($request->features, function($feature) {
            return !empty(trim($feature));
        });

        // Handle pricing tiers for wedding packages
        if ($request->type === 'wedding' && $request->pricing_tiers) {
            $data['pricing_tiers'] = array_filter($request->pricing_tiers, function($tier) {
                return !empty($tier['guests']) && !empty($tier['price']);
            });
        }

        $package->update($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified package
     */
    public function destroy(Package $package)
    {
        // Delete associated image - FIXED VERSION
        if ($package->image_path) {
            $imagePath = public_path('storage/' . $package->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package deleted successfully.');
    }

    /**
     * Toggle package status
     */
    public function toggleStatus(Package $package)
    {
        $package->update(['is_active' => !$package->is_active]);

        $status = $package->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Package {$status} successfully.");
    }

    /**
     * Update sort order via AJAX
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'packages' => 'required|array',
            'packages.*' => 'integer|exists:packages,id',
        ]);

        try {
            foreach ($request->packages as $index => $id) {
                Package::where('id', $id)->update(['sort_order' => $index + 1]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Package order updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update package order.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}