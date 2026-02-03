<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display all menu categories
     */
    public function index()
    {
        $categories = MenuCategory::active()->ordered()->get();
        
        return view('menu.index', compact('categories'));
    }

    /**
     * Display a specific menu category
     */
    public function show(MenuCategory $menu)
    {
        if (!$menu->is_active) {
            abort(404);
        }
        
        return view('menu.show', compact('menu'));
    }
}
