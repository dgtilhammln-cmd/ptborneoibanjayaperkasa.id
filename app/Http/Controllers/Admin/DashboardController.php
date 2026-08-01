<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TrackingService;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = TrackingService::getStatistics('30d');

        $visitorCount = (int) ($stats['visitors']['period'] ?? 0);
        $pageViewCount = (int) ($stats['page_views']['period'] ?? 0);

        $phoneLeads = (int) (($stats['cta_clicks']['by_type'] ?? collect())
            ->where('cta_type', 'phone')
            ->first()
            ->clicks ?? 0);

        $emailLeads = (int) (($stats['cta_clicks']['by_type'] ?? collect())
            ->where('cta_type', 'email')
            ->first()
            ->clicks ?? 0);

        $waLeads = (int) (($stats['cta_clicks']['by_type'] ?? collect())
            ->where('cta_type', 'whatsapp')
            ->first()
            ->clicks ?? 0);

        $maxForBars = max(1, $visitorCount, $phoneLeads, $emailLeads, $waLeads);

        $visitorBar = (int) round(min(100, ($visitorCount / $maxForBars) * 100));
        $phoneBar = (int) round(min(100, ($phoneLeads / $maxForBars) * 100));
        $emailBar = (int) round(min(100, ($emailLeads / $maxForBars) * 100));
        $waBar = (int) round(min(100, ($waLeads / $maxForBars) * 100));

        return view('dashboard', compact(
            'stats',
            'visitorCount',
            'pageViewCount',
            'phoneLeads',
            'emailLeads',
            'waLeads',
            'visitorBar',
            'phoneBar',
            'emailBar',
            'waBar'
        ));
    }
}
