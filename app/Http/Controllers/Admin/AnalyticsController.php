<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TrackingService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $period = $request->get('period', '7d');
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            $stats = TrackingService::getStatistics($period, $startDate, $endDate);
            
            // Ensure all required keys exist
            $defaultStats = [
                'visitors' => ['total' => 0, 'period' => 0, 'unique_today' => 0],
                'page_views' => ['total' => 0, 'period' => 0, 'today' => 0, 'popular_pages' => collect()],
                'blog_views' => ['total' => 0, 'period' => 0, 'today' => 0, 'popular_blogs' => collect()],
                'cta_clicks' => ['total' => 0, 'period' => 0, 'today' => 0, 'by_type' => collect()],
                'device_stats' => ['by_device' => collect(), 'by_browser' => collect()],
                'location_stats' => ['by_country' => collect(), 'by_city' => collect()],
                'daily_stats' => ['visitors' => collect(), 'page_views' => collect()],
            ];
            
            $stats = array_merge($defaultStats, $stats);

            return view('admin.analytics.index', compact('stats', 'period'));
        } catch (\Exception $e) {
            \Log::error('Analytics error: ' . $e->getMessage());
            
            // Return default stats on error
            $stats = [
                'visitors' => ['total' => 0, 'period' => 0, 'unique_today' => 0],
                'page_views' => ['total' => 0, 'period' => 0, 'today' => 0, 'popular_pages' => collect()],
                'blog_views' => ['total' => 0, 'period' => 0, 'today' => 0, 'popular_blogs' => collect()],
                'cta_clicks' => ['total' => 0, 'period' => 0, 'today' => 0, 'by_type' => collect()],
                'device_stats' => ['by_device' => collect(), 'by_browser' => collect()],
                'location_stats' => ['by_country' => collect(), 'by_city' => collect()],
                'daily_stats' => ['visitors' => collect(), 'page_views' => collect()],
            ];
            $period = $request->get('period', '7d');
            
            return view('admin.analytics.index', compact('stats', 'period'))
                ->with('error', 'Error loading analytics data. Please try again.');
        }
    }
}
