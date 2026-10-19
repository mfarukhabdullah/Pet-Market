<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Listing;
use App\Models\SiteSetting;

// USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
class SeoController extends Controller
{
    /**
     * Generate dynamic XML sitemap for search engines.
     */
    public function sitemap()
    {
        $categories = Category::where('is_active', true)->get();
        $listings = Listing::where('status', 'live')->latest()->take(500)->get();

        return response()->view('seo.sitemap', compact('categories', 'listings'))
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Generate dynamic robots.txt.
     */
    public function robots()
    {
        $robotsDirective = SiteSetting::get('seo_robots', 'index, follow');
        $sitemapUrl = url('/sitemap.xml');

        $content = "User-agent: *\n";
        if (strpos($robotsDirective, 'noindex') !== false) {
            $content .= "Disallow: /\n";
        } else {
            $content .= "Disallow: /admin/\n";
            $content .= "Disallow: /seller/\n";
            $content .= "Disallow: /dashboard\n";
            $content .= "Allow: /\n";
        }
        $content .= "\nSitemap: {$sitemapUrl}\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
