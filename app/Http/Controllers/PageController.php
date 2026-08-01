<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\TrackingService;

class PageController extends Controller
{
    /**
     * Display a dynamic page by slug
     */
    public function show(Request $request, string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Set SEO meta tags
        SEOTools::setTitle($page->seo_title);

        if ($page->meta_description) {
            SEOTools::setDescription($page->meta_description);
        }

        if ($page->meta_keywords) {
            SEOTools::metatags()->setKeywords(explode(',', $page->meta_keywords));
        }

        if ($page->og_image) {
            SEOTools::opengraph()->addImage(url($page->og_image));
        } elseif ($page->featured_image) {
            SEOTools::opengraph()->addImage(url($page->featured_image));
        }

        // Track page view
        TrackingService::trackPageView($request, '/page/' . $slug, $page->title);

        return view('frontend.page', compact('page'));
    }
}
