<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $baseUrl = config('app.url');
        $now = now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static pages
        $staticPages = [
            ['url' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => $baseUrl . '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => $baseUrl . '/services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . '/blog', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . '/products', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $page) {
            $xml .= $this->urlElement($page['url'], $now, $page['changefreq'], $page['priority']);
        }

        // Services
        $services = Service::all();
        foreach ($services as $service) {
            $xml .= $this->urlElement(
                $baseUrl . '/services/' . $service->slug,
                $service->updated_at ? $service->updated_at->toAtomString() : $now,
                'monthly',
                '0.8'
            );
        }

        // Blog posts
        $blogs = Blog::where('status', 'published')->get();
        foreach ($blogs as $blog) {
            $xml .= $this->urlElement(
                $baseUrl . '/blog/' . $blog->slug,
                $blog->updated_at ? $blog->updated_at->toAtomString() : $now,
                'weekly',
                '0.8'
            );
        }

        // Products
        $products = Product::all();
        foreach ($products as $product) {
            $xml .= $this->urlElement(
                $baseUrl . '/products/' . $product->slug,
                $product->updated_at ? $product->updated_at->toAtomString() : $now,
                'weekly',
                '0.8'
            );
        }

        // Dynamic Pages
        $pages = Page::where('is_published', true)->get();
        foreach ($pages as $page) {
            $xml .= $this->urlElement(
                $baseUrl . '/page/' . $page->slug,
                $page->updated_at ? $page->updated_at->toAtomString() : $now,
                'monthly',
                '0.7'
            );
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function urlElement($url, $lastmod, $changefreq, $priority)
    {
        return "  <url>\n" .
               "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n" .
               "    <lastmod>" . htmlspecialchars($lastmod, ENT_XML1) . "</lastmod>\n" .
               "    <changefreq>" . htmlspecialchars($changefreq, ENT_XML1) . "</changefreq>\n" .
               "    <priority>" . htmlspecialchars($priority, ENT_XML1) . "</priority>\n" .
               "  </url>\n";
    }

    public function robots()
    {
        $baseUrl = config('app.url');
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /dashboard\n";
        $content .= "Disallow: /profile\n";
        $content .= "Disallow: /api/\n";
        $content .= "\n";
        $content .= "Sitemap: {$baseUrl}/sitemap.xml\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}

