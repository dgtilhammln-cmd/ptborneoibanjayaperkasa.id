<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TrackingService;

class TrackingController extends Controller
{
    /**
     * Track CTA click via AJAX
     */
    public function trackCta(Request $request)
    {
        $request->validate([
            'cta_type' => 'required|string',
            'cta_label' => 'nullable|string',
            'cta_url' => 'nullable|string',
            'page_path' => 'nullable|string',
        ]);

        try {
            $tracked = TrackingService::trackCtaClick(
                $request,
                $request->cta_type,
                $request->cta_label,
                $request->cta_url,
                $request->page_path
            );

            return response()->json(['success' => (bool) $tracked], $tracked ? 200 : 202);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Track blog view
     */
    public function trackBlogView(Request $request, $blogId)
    {
        try {
            $tracked = TrackingService::trackBlogView($request, $blogId);
            return response()->json(['success' => (bool) $tracked], $tracked ? 200 : 202);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}

