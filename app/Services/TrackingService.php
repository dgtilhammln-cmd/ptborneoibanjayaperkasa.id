<?php

namespace App\Services;

use App\Models\Visitor;
use App\Models\PageView;
use App\Models\BlogView;
use App\Models\CtaClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Throwable;

class TrackingService
{
    /**
     * Get or create visitor based on IP address
     */
    public static function getOrCreateVisitor(Request $request): Visitor
    {
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();
        
        $visitor = Visitor::where('ip_address', $ipAddress)->first();
        
        if ($visitor) {
            // Update last visit
            $visitor->update([
                'last_visit' => now(),
                'visit_count' => $visitor->visit_count + 1,
                'user_agent' => $userAgent,
            ]);
        } else {
            // Create new visitor
            $deviceInfo = self::parseUserAgent($userAgent);
            $locationInfo = self::getLocationFromIp($ipAddress);
            
            $visitor = Visitor::create([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'referer' => $request->header('referer'),
                'device_type' => $deviceInfo['device_type'],
                'browser' => $deviceInfo['browser'],
                'os' => $deviceInfo['os'],
                'country' => $locationInfo['country'] ?? null,
                'city' => $locationInfo['city'] ?? null,
                'first_visit' => now(),
                'last_visit' => now(),
                'visit_count' => 1,
            ]);
        }
        
        return $visitor;
    }

    /**
     * Get location from IP address using free IP geolocation API
     */
    protected static function getLocationFromIp(string $ipAddress): array
    {
        // Skip local/private IPs
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return ['country' => null, 'city' => null];
        }

        try {
            // Using ip-api.com (free, no API key required, 45 requests/minute)
            $url = "http://ip-api.com/json/{$ipAddress}?fields=status,country,city";
            $context = stream_context_create([
                'http' => [
                    'timeout' => 2,
                    'method' => 'GET',
                ]
            ]);
            
            $response = @file_get_contents($url, false, $context);
            
            if ($response) {
                $data = json_decode($response, true);
                if (isset($data['status']) && $data['status'] === 'success') {
                    return [
                        'country' => $data['country'] ?? null,
                        'city' => $data['city'] ?? null,
                    ];
                }
            }
        } catch (\Exception $e) {
            // Silently fail if geolocation service is unavailable
        }

        return ['country' => null, 'city' => null];
    }

    /**
     * Track page view
     */
    public static function trackPageView(Request $request, string $pagePath, ?string $pageName = null): ?PageView
    {
        try {
            $visitor = self::getOrCreateVisitor($request);

            return PageView::create([
                'page_path' => $pagePath,
                'page_name' => $pageName,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referer' => $request->header('referer'),
                'visitor_id' => $visitor->id,
            ]);
        } catch (Throwable $e) {
            \Log::warning('trackPageView failed', ['message' => $e->getMessage(), 'path' => $pagePath]);
            return null;
        }
    }

    /**
     * Track blog view
     */
    public static function trackBlogView(Request $request, int $blogId): ?BlogView
    {
        try {
            $visitor = self::getOrCreateVisitor($request);

            return BlogView::create([
                'blog_id' => $blogId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referer' => $request->header('referer'),
                'visitor_id' => $visitor->id,
            ]);
        } catch (Throwable $e) {
            \Log::warning('trackBlogView failed', ['message' => $e->getMessage(), 'blog_id' => $blogId]);
            return null;
        }
    }

    /**
     * Track CTA click
     */
    public static function trackCtaClick(Request $request, string $ctaType, ?string $ctaLabel = null, ?string $ctaUrl = null, ?string $pagePath = null): ?CtaClick
    {
        try {
            $visitor = self::getOrCreateVisitor($request);

            return CtaClick::create([
                'cta_type' => $ctaType,
                'cta_label' => $ctaLabel,
                'cta_url' => $ctaUrl,
                'page_path' => $pagePath ?? $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visitor_id' => $visitor->id,
            ]);
        } catch (Throwable $e) {
            \Log::warning('trackCtaClick failed', ['message' => $e->getMessage(), 'cta_type' => $ctaType]);
            return null;
        }
    }

    /**
     * Parse user agent to get device info
     */
    protected static function parseUserAgent(?string $userAgent): array
    {
        if (!$userAgent) {
            return [
                'device_type' => 'unknown',
                'browser' => 'unknown',
                'os' => 'unknown',
            ];
        }

        $deviceType = 'desktop';
        $browser = 'unknown';
        $os = 'unknown';

        // Detect device type
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobi))/i', $userAgent)) {
            $deviceType = 'tablet';
        } elseif (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $userAgent)) {
            $deviceType = 'mobile';
        }

        // Detect browser
        if (preg_match('/MSIE|Trident/i', $userAgent)) {
            $browser = 'Internet Explorer';
        } elseif (preg_match('/Edg/i', $userAgent)) {
            $browser = 'Microsoft Edge';
        } elseif (preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Opera|OPR/i', $userAgent)) {
            $browser = 'Opera';
        }

        // Detect OS
        if (preg_match('/Windows/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/Mac OS X/i', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iOS|iPhone|iPad/i', $userAgent)) {
            $os = 'iOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $os = 'Linux';
        }

        return [
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
        ];
    }

    /**
     * Get statistics for analytics dashboard
     */
    public static function getStatistics(?string $period = '7d', ?string $startDate = null, ?string $endDate = null): array
    {
        [$rangeStart, $rangeEnd] = self::resolveDateRange($period, $startDate, $endDate);

        $applyDateRange = function ($query, string $column = 'created_at') use ($rangeStart, $rangeEnd) {
            if ($rangeEnd) {
                $query->whereBetween($column, [$rangeStart, $rangeEnd]);
            } else {
                $query->where($column, '>=', $rangeStart);
            }

            return $query;
        };

        return [
            'visitors' => [
                'total' => Visitor::count(),
                'period' => $applyDateRange(Visitor::query())->count(),
                'unique_today' => Visitor::whereDate('last_visit', today())->count(),
            ],
            'page_views' => [
                'total' => PageView::count(),
                'period' => $applyDateRange(PageView::query())->count(),
                'today' => PageView::whereDate('created_at', today())->count(),
                'popular_pages' => PageView::select('page_path', 'page_name', DB::raw('count(*) as views'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->groupBy('page_path', 'page_name')
                    ->orderBy('views', 'desc')
                    ->limit(10)
                    ->get(),
            ],
            'blog_views' => [
                'total' => BlogView::count(),
                'period' => $applyDateRange(BlogView::query())->count(),
                'today' => BlogView::whereDate('created_at', today())->count(),
                'popular_blogs' => BlogView::with('blog')
                    ->select('blog_id', DB::raw('count(*) as views'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->groupBy('blog_id')
                    ->orderBy('views', 'desc')
                    ->limit(10)
                    ->get(),
            ],
            'cta_clicks' => [
                'total' => CtaClick::count(),
                'period' => $applyDateRange(CtaClick::query())->count(),
                'today' => CtaClick::whereDate('created_at', today())->count(),
                'by_type' => CtaClick::select('cta_type', DB::raw('count(*) as clicks'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->groupBy('cta_type')
                    ->orderBy('clicks', 'desc')
                    ->get(),
            ],
            'device_stats' => [
                'by_device' => Visitor::select('device_type', DB::raw('count(*) as count'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->groupBy('device_type')
                    ->get(),
                'by_browser' => Visitor::select('browser', DB::raw('count(*) as count'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->groupBy('browser')
                    ->orderBy('count', 'desc')
                    ->limit(5)
                    ->get(),
            ],
            'location_stats' => [
                'by_country' => Visitor::select('country', DB::raw('count(*) as count'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->whereNotNull('country')
                    ->groupBy('country')
                    ->orderBy('count', 'desc')
                    ->limit(10)
                    ->get(),
                'by_city' => Visitor::select('city', 'country', DB::raw('count(*) as count'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->whereNotNull('city')
                    ->groupBy('city', 'country')
                    ->orderBy('count', 'desc')
                    ->limit(10)
                    ->get(),
            ],
            'daily_stats' => [
                'visitors' => Visitor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->orderBy('date', 'asc')
                    ->get()
                    ->map(function($item) {
                        return [
                            'date' => $item->date instanceof \Carbon\Carbon ? $item->date->format('Y-m-d') : $item->date,
                            'count' => (int)$item->count
                        ];
                    }),
                'page_views' => PageView::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->orderBy('date', 'asc')
                    ->get()
                    ->map(function($item) {
                        return [
                            'date' => $item->date instanceof \Carbon\Carbon ? $item->date->format('Y-m-d') : $item->date,
                            'count' => (int)$item->count
                        ];
                    }),
                'cta_clicks' => CtaClick::select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('cta_type as type'),
                        DB::raw('count(*) as count')
                    )
                    ->when(true, fn ($query) => $applyDateRange($query))
                    ->groupBy(DB::raw('DATE(created_at)'), 'cta_type')
                    ->orderBy('date', 'asc')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'date' => $item->date instanceof Carbon ? $item->date->format('Y-m-d') : $item->date,
                            'type' => (string) $item->type,
                            'count' => (int) $item->count,
                        ];
                    }),
            ],
        ];
    }

    /**
     * Get date filter based on period
     */
    protected static function resolveDateRange(string $period, ?string $startDate = null, ?string $endDate = null): array
    {
        if ($startDate || $endDate) {
            $start = $startDate ? Carbon::parse($startDate)->startOfDay() : now()->subDays(7)->startOfDay();
            $end = $endDate ? Carbon::parse($endDate)->endOfDay() : now()->endOfDay();
            return [$start, $end];
        }

        $start = match($period) {
            'today' => today()->startOfDay(),
            '7d' => now()->subDays(7)->startOfDay(),
            '30d' => now()->subDays(30)->startOfDay(),
            '90d' => now()->subDays(90)->startOfDay(),
            '1y' => now()->subYear()->startOfDay(),
            default => now()->subDays(7)->startOfDay(),
        };

        return [$start, null];
    }
}

