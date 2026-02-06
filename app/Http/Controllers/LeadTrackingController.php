<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class LeadTrackingController extends Controller
{
    /**
     * Track a lead event from the Package Builder frontend.
     * Called via AJAX — no auth required.
     */
    public function track(Request $request)
    {
        $validated = $request->validate([
            'event' => 'required|in:started,browsing,package_selected,reviewed,paid',
            'session_id' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'package_type' => 'nullable|string|max:50',
            'package_id' => 'nullable|integer',
            'package_name' => 'nullable|string|max:255',
            'adults' => 'nullable|integer|min:0',
            'children' => 'nullable|integer|min:0',
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date',
            'estimated_value' => 'nullable|numeric|min:0',
        ]);

        $sessionId = $validated['session_id'];
        $event = $validated['event'];

        // Map frontend events to lead statuses
        $statusMap = [
            'started' => 'started',
            'browsing' => 'browsing',
            'package_selected' => 'browsing',
            'reviewed' => 'reviewed',
            'paid' => 'paid',
        ];

        // Find existing lead for this session or create new
        $lead = Lead::where('session_id', $sessionId)->first();

        // Detect device type
        $deviceType = 'desktop';
        $userAgent = $request->userAgent();
        if ($userAgent) {
            if (preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent)) {
                $deviceType = preg_match('/iPad|Tablet/i', $userAgent) ? 'tablet' : 'mobile';
            }
        }

        $data = [
            'status' => $statusMap[$event] ?? 'started',
            'last_activity_at' => now(),
        ];

        // Only update fields if they have values
        if (!empty($validated['category'])) $data['category'] = $validated['category'];
        if (!empty($validated['package_type'])) $data['package_type'] = $validated['package_type'];
        if (!empty($validated['package_id'])) $data['custom_package_id'] = $validated['package_id'];
        if (!empty($validated['package_name'])) $data['package_name'] = $validated['package_name'];
        if (isset($validated['adults'])) $data['adults'] = $validated['adults'];
        if (isset($validated['children'])) $data['children'] = $validated['children'];
        if (!empty($validated['check_in'])) $data['check_in'] = $validated['check_in'];
        if (!empty($validated['check_out'])) $data['check_out'] = $validated['check_out'];
        if (!empty($validated['estimated_value'])) $data['estimated_value'] = $validated['estimated_value'];

        if ($lead) {
            // Don't downgrade status (e.g., don't go from 'reviewed' back to 'browsing')
            $statusOrder = ['started' => 1, 'browsing' => 2, 'reviewed' => 3, 'paid' => 4, 'abandoned' => 5, 'converted' => 6];
            $currentOrder = $statusOrder[$lead->status] ?? 0;
            $newOrder = $statusOrder[$data['status']] ?? 0;

            if ($newOrder <= $currentOrder && !in_array($data['status'], ['paid', 'converted'])) {
                unset($data['status']);
            }

            // Attach user if now logged in
            if (auth()->check() && !$lead->user_id) {
                $data['user_id'] = auth()->id();
            }

            $lead->update($data);
        } else {
            // Create new lead
            $data['session_id'] = $sessionId;
            $data['source'] = 'package_builder';
            $data['device_type'] = $deviceType;
            $data['ip_address'] = $request->ip();
            $data['referrer_url'] = $request->header('Referer');
            $data['landing_page'] = $request->header('Referer');
            $data['user_id'] = auth()->check() ? auth()->id() : null;

            // UTM parameters from referrer or session
            $data['utm_source'] = $request->get('utm_source');
            $data['utm_medium'] = $request->get('utm_medium');
            $data['utm_campaign'] = $request->get('utm_campaign');

            $lead = Lead::create($data);
        }

        return response()->json([
            'success' => true,
            'lead_id' => $lead->id,
        ]);
    }
}
