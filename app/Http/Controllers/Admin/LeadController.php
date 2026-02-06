<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeadController extends Controller
{
    /**
     * Leads/CRM Dashboard with funnel stats and filterable table
     */
    public function index(Request $request)
    {
        // --- Funnel Stats (last 30 days) ---
        $period = $request->get('period', 30);
        $since = now()->subDays($period);

        $stats = [
            'total'     => Lead::where('created_at', '>=', $since)->count(),
            'started'   => Lead::where('created_at', '>=', $since)->where('status', 'started')->count(),
            'browsing'  => Lead::where('created_at', '>=', $since)->where('status', 'browsing')->count(),
            'reviewed'  => Lead::where('created_at', '>=', $since)->where('status', 'reviewed')->count(),
            'paid'      => Lead::where('created_at', '>=', $since)->where('status', 'paid')->count(),
            'abandoned' => Lead::where('created_at', '>=', $since)->where('status', 'abandoned')->count(),
            'converted' => Lead::where('created_at', '>=', $since)->where('status', 'converted')->count(),
        ];

        // Revenue from converted leads
        $stats['revenue'] = Lead::where('created_at', '>=', $since)
            ->where('status', 'converted')
            ->sum('estimated_value');

        // Lost revenue from abandoned leads
        $stats['lost_revenue'] = Lead::where('created_at', '>=', $since)
            ->where('status', 'abandoned')
            ->sum('estimated_value');

        // Conversion rate
        $stats['conversion_rate'] = $stats['total'] > 0
            ? round(($stats['converted'] / $stats['total']) * 100, 1)
            : 0;

        // Needs follow-up count
        $stats['needs_followup'] = Lead::needsFollowUp()->count();

        // --- Category breakdown ---
        $categoryStats = Lead::where('created_at', '>=', $since)
            ->whereNotNull('category')
            ->selectRaw('category, COUNT(*) as total, SUM(CASE WHEN status = "converted" THEN 1 ELSE 0 END) as converted')
            ->groupBy('category')
            ->get();

        // --- Source breakdown ---
        $sourceStats = Lead::where('created_at', '>=', $since)
            ->selectRaw('source, COUNT(*) as total, SUM(CASE WHEN status = "converted" THEN 1 ELSE 0 END) as converted')
            ->groupBy('source')
            ->get();

        // --- Filterable Leads Table ---
        $query = Lead::with(['user', 'customPackage', 'booking']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('guest_name', 'like', "%{$search}%")
                  ->orWhere('guest_email', 'like', "%{$search}%")
                  ->orWhere('guest_phone', 'like', "%{$search}%")
                  ->orWhere('package_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', Carbon::parse($request->date_to)->endOfDay());
        }

        // Priority sort: needs follow-up first, then most recent
        $leads = $query->orderByRaw("CASE 
                WHEN status IN ('abandoned', 'reviewed') AND followed_up_at IS NULL THEN 0 
                WHEN status = 'started' THEN 1 
                WHEN status = 'browsing' THEN 2 
                ELSE 3 
            END")
            ->orderBy('created_at', 'desc')
            ->paginate(25)
            ->appends($request->query());

        return view('admin.leads.index', compact('leads', 'stats', 'categoryStats', 'sourceStats', 'period'));
    }

    /**
     * Update lead notes / follow-up status
     */
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'staff_notes' => 'nullable|string|max:2000',
            'status' => 'nullable|in:started,browsing,reviewed,paid,abandoned,converted',
            'guest_name' => 'nullable|string|max:255',
            'guest_phone' => 'nullable|string|max:20',
            'guest_email' => 'nullable|string|email|max:255',
        ]);

        $lead->update(array_filter($validated, fn($v) => $v !== null));

        return redirect()->back()->with('success', 'Lead updated successfully.');
    }

    /**
     * Mark a lead as followed up
     */
    public function markFollowedUp(Lead $lead)
    {
        $lead->update([
            'followed_up_at' => now(),
            'followed_up_by' => auth()->user()->name,
        ]);

        return redirect()->back()->with('success', 'Lead marked as followed up.');
    }

    /**
     * Delete a lead
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->back()->with('success', 'Lead deleted.');
    }

    /**
     * Bulk mark stale leads as abandoned (called via Artisan or manually)
     */
    public function markStaleAsAbandoned()
    {
        $staleThreshold = now()->subHours(2);

        $count = Lead::whereIn('status', ['started', 'browsing'])
            ->where('last_activity_at', '<', $staleThreshold)
            ->update([
                'status' => 'abandoned',
                'last_activity_at' => now(),
            ]);

        return redirect()->back()->with('success', "{$count} stale leads marked as abandoned.");
    }

    /**
     * Create a manual lead (e.g., from a phone call or walk-in)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'nullable|string|max:20',
            'guest_email' => 'nullable|string|email|max:255',
            'source' => 'required|in:whatsapp,phone,manual,contact_form',
            'category' => 'nullable|in:couple,family,group,wedding',
            'package_type' => 'nullable|string',
            'adults' => 'nullable|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date',
            'estimated_value' => 'nullable|numeric|min:0',
            'staff_notes' => 'nullable|string|max:2000',
        ]);

        $validated['session_id'] = 'manual_' . uniqid();
        $validated['status'] = 'started';
        $validated['last_activity_at'] = now();

        Lead::create($validated);

        return redirect()->back()->with('success', 'Lead created successfully.');
    }
}
