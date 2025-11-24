<?php
// app/Http/Controllers/PackageController.php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display couple packages page
     */
    public function couples()
    {
        $packages = Package::active()
            ->ofType('couple')
            ->ordered()
            ->get();

        return view('packages.couples', compact('packages'));
    }

    /**
     * Display family packages page
     */
    public function family()
    {
        $packages = Package::active()
            ->ofType('family')
            ->ordered()
            ->get();

        return view('packages.family', compact('packages'));
    }

    /**
     * Display group packages page
     */
    public function group()
    {
        $packages = Package::active()
            ->ofType('group')
            ->ordered()
            ->get();

        return view('packages.group', compact('packages'));
    }

    /**
     * Display wedding packages page
     */
    public function wedding()
    {
        $packages = Package::active()
            ->ofType('wedding')
            ->ordered()
            ->get();

        return view('packages.wedding', compact('packages'));
    }

    /**
     * Display engagement packages page
     */
    public function engagement()
    {
        $packages = Package::active()
            ->ofType('engagement')
            ->ordered()
            ->get();

        return view('packages.engagement', compact('packages'));
    }

    /**
     * Display birthday packages page
     */
    public function birthday()
    {
        $packages = Package::active()
            ->ofType('birthday')
            ->ordered()
            ->get();

        return view('packages.birthday', compact('packages'));
    }

    /**
     * Display honeymoon packages page
     */
    public function honeymoon()
    {
        $packages = Package::active()
            ->ofType('honeymoon')
            ->ordered()
            ->get();

        return view('packages.honeymoon', compact('packages'));
    }

    /**
     * Display single package details
     */
    public function show(Package $package)
    {
        if (!$package->is_active) {
            abort(404);
        }

        return view('packages.show', compact('package'));
    }
}