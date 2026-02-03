<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of menu categories
     */
    public function index()
    {
        $categories = MenuCategory::orderBy('sort_order')->orderBy('name')->get();
        return view('admin.menu-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('admin.menu-categories.create');
    }

    /**
     * Store a newly created category
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:menu_categories,slug',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'menu_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except(['image', 'menu_image']);
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->name);
        }

        // Handle cover image upload
        if ($request->hasFile('image')) {
            $uploadDir = public_path('storage/menu-categories');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $image = $request->file('image');
            $filename = 'cover_' . uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $data['image_path'] = 'menu-categories/' . $filename;
        }

        // Handle menu image upload (A4 JPG)
        if ($request->hasFile('menu_image')) {
            $uploadDir = public_path('storage/menu-categories');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $menuImage = $request->file('menu_image');
            $filename = 'menu_' . uniqid() . '_' . time() . '.' . $menuImage->getClientOriginalExtension();
            $menuImage->move($uploadDir, $filename);
            $data['menu_image_path'] = 'menu-categories/' . $filename;
        }

        // Filter out empty features
        if (isset($data['features'])) {
            $data['features'] = array_values(array_filter($data['features'], function($feature) {
                return !empty(trim($feature));
            }));
        }

        // Set sort order to the highest + 1 if not provided
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $maxSortOrder = MenuCategory::max('sort_order') ?? 0;
            $data['sort_order'] = $maxSortOrder + 1;
        }

        MenuCategory::create($data);

        return redirect()->route('admin.menu-categories.index')
            ->with('success', 'Menu category created successfully.');
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(MenuCategory $menuCategory)
    {
        return view('admin.menu-categories.edit', compact('menuCategory'));
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:menu_categories,slug,' . $menuCategory->id,
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'menu_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except(['image', 'menu_image']);
        
        // Handle checkbox - if not present, set to false
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->name);
        }

        // Handle cover image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($menuCategory->image_path) {
                $oldPath = public_path('storage/' . $menuCategory->image_path);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $uploadDir = public_path('storage/menu-categories');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $image = $request->file('image');
            $filename = 'cover_' . uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $data['image_path'] = 'menu-categories/' . $filename;
        }

        // Handle menu image upload (A4 JPG)
        if ($request->hasFile('menu_image')) {
            // Delete old menu image
            if ($menuCategory->menu_image_path) {
                $oldPath = public_path('storage/' . $menuCategory->menu_image_path);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $uploadDir = public_path('storage/menu-categories');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $menuImage = $request->file('menu_image');
            $filename = 'menu_' . uniqid() . '_' . time() . '.' . $menuImage->getClientOriginalExtension();
            $menuImage->move($uploadDir, $filename);
            $data['menu_image_path'] = 'menu-categories/' . $filename;
        }

        // Filter out empty features
        if (isset($data['features'])) {
            $data['features'] = array_values(array_filter($data['features'], function($feature) {
                return !empty(trim($feature));
            }));
        }

        $menuCategory->update($data);

        return redirect()->route('admin.menu-categories.index')
            ->with('success', 'Menu category updated successfully.');
    }

    /**
     * Remove the specified category
     */
    public function destroy(MenuCategory $menuCategory)
    {
        // Delete associated images
        if ($menuCategory->image_path) {
            $imagePath = public_path('storage/' . $menuCategory->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($menuCategory->menu_image_path) {
            $menuImagePath = public_path('storage/' . $menuCategory->menu_image_path);
            if (file_exists($menuImagePath)) {
                unlink($menuImagePath);
            }
        }

        $menuCategory->delete();

        return redirect()->route('admin.menu-categories.index')
            ->with('success', 'Menu category deleted successfully.');
    }

    /**
     * Toggle category status
     */
    public function toggleStatus(MenuCategory $menuCategory)
    {
        $menuCategory->update(['is_active' => !$menuCategory->is_active]);

        $status = $menuCategory->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Menu category {$status} successfully.");
    }

    /**
     * Remove cover image
     */
    public function removeImage(MenuCategory $menuCategory)
    {
        if ($menuCategory->image_path) {
            $imagePath = public_path('storage/' . $menuCategory->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $menuCategory->update(['image_path' => null]);
        }

        return redirect()->back()->with('success', 'Cover image removed successfully.');
    }

    /**
     * Remove menu image
     */
    public function removeMenuImage(MenuCategory $menuCategory)
    {
        if ($menuCategory->menu_image_path) {
            $menuImagePath = public_path('storage/' . $menuCategory->menu_image_path);
            if (file_exists($menuImagePath)) {
                unlink($menuImagePath);
            }
            $menuCategory->update(['menu_image_path' => null]);
        }

        return redirect()->back()->with('success', 'Menu image removed successfully.');
    }

    /**
     * Update sort order via AJAX
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:menu_categories,id',
        ]);

        try {
            foreach ($request->categories as $index => $id) {
                MenuCategory::where('id', $id)->update(['sort_order' => $index + 1]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Category order updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category order.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload menu images for a category
     */
    public function uploadMenuImages(Request $request, MenuCategory $menuCategory)
    {
        $request->validate([
            'menu_images' => 'required|array',
            'menu_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string|max:255',
        ]);

        $uploadDir = public_path('storage/menu-categories');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $maxSortOrder = $menuCategory->menuImages()->max('sort_order') ?? 0;

        foreach ($request->file('menu_images') as $index => $image) {
            $filename = 'menu_' . $menuCategory->id . '_' . uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);

            MenuImage::create([
                'menu_category_id' => $menuCategory->id,
                'image_path' => 'menu-categories/' . $filename,
                'title' => $request->titles[$index] ?? null,
                'sort_order' => ++$maxSortOrder,
            ]);
        }

        return redirect()->back()->with('success', 'Menu images uploaded successfully.');
    }

    /**
     * Delete a specific menu image
     */
    public function deleteMenuImage(MenuImage $menuImage)
    {
        $imagePath = public_path('storage/' . $menuImage->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $menuImage->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }

    /**
     * Update menu image sort order
     */
    public function updateMenuImageOrder(Request $request, MenuCategory $menuCategory)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'integer|exists:menu_images,id',
        ]);

        foreach ($request->images as $index => $id) {
            MenuImage::where('id', $id)->where('menu_category_id', $menuCategory->id)
                ->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
