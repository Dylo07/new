<?php

namespace App\Http\Controllers;

use App\Models\CustomPackage;
use Illuminate\Http\Request;

class PackageBuilderController extends Controller
{
    public function index()
    {
        return view('package-builder.index');
    }

    public function getPackages(Request $request)
    {
        $adults = (int) $request->adults;
        $children = (int) $request->children;
        $totalGuests = $adults + $children;

        // Determine category based on guest count
        if ($totalGuests <= 2) {
            $category = 'couple';
        } elseif ($totalGuests < 10) {
            $category = 'family';
        } else {
            $category = 'group';
        }

        // Get packages for the category
        $packages = CustomPackage::active()
            ->category($category)
            ->orderBy('type')
            ->orderBy('sub_type')
            ->get()
            ->groupBy(['type', 'sub_type']);

        // Check availability for packages with minimum requirements
        $availablePackages = $packages->map(function ($types) use ($adults) {
            return $types->map(function ($subTypes) use ($adults) {
                return $subTypes->map(function ($package) use ($adults) {
                    $package->available = $package->isAvailableFor($adults);
                    return $package;
                });
            });
        });

        return response()->json([
            'category' => $category,
            'packages' => $availablePackages,
            'adults' => $adults,
            'children' => $children
        ]);
    }

    public function calculatePrice(Request $request)
    {
        $packageId = $request->package_id;
        $adults = (int) $request->adults;
        $children = (int) $request->children;

        $package = CustomPackage::find($packageId);

        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }

        if (!$package->isAvailableFor($adults)) {
            return response()->json(['error' => 'Package not available for this number of adults'], 400);
        }

        $total = $package->calculateTotal($adults, $children);

        return response()->json([
            'package' => $package,
            'adults' => $adults,
            'children' => $children,
            'adult_price' => $package->adult_price,
            'child_price' => $package->child_price,
            'subtotal_adults' => $package->adult_price * $adults,
            'subtotal_children' => $package->child_price * $children,
            'total' => $total,
            'formatted_total' => 'Rs ' . number_format($total, 0)
        ]);
    }
}