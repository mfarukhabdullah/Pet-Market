<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

// USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Retrieve a setting value by key with optional fallback.
     */
    public static function get($key, $default = null)
    {
        try {
            $settings = Cache::rememberForever('site_settings_cache', function () {
                return static::all()->pluck('value', 'key')->toArray();
            });

            return array_key_exists($key, $settings) ? $settings[$key] : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Store or update a setting.
     */
    public static function set($key, $value, $group = 'general')
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        Cache::forget('site_settings_cache');
        return $setting;
    }

    /**
     * Seed initial sensible defaults if settings are empty.
     */
    public static function seedDefaults()
    {
        $defaults = [
            // SEO & Meta Settings
            'seo_meta_title' => ['value' => 'Pet Marketplace - Buy & Sell Verified Pets in Pakistan', 'group' => 'seo'],
            'seo_meta_description' => ['value' => 'Discover verified dogs, cats, birds, and exotic pets from trusted breeders and owners across Lahore, Karachi, Islamabad, and all over Pakistan.', 'group' => 'seo'],
            'seo_meta_keywords' => ['value' => 'pets for sale pakistan, buy dogs lahore, persian kittens karachi, bird marketplace islamabad, pet shop online', 'group' => 'seo'],
            'seo_canonical_base' => ['value' => 'http://127.0.0.1:8000', 'group' => 'seo'],
            'seo_robots' => ['value' => 'index, follow', 'group' => 'seo'],
            'seo_og_title' => ['value' => 'Pet Marketplace Pakistan - Safe, Trusted Pet Community', 'group' => 'seo'],
            'seo_og_description' => ['value' => 'Buy, adopt, and sell pets with safety checks, direct seller messaging, and trusted local communities.', 'group' => 'seo'],
            'seo_og_image' => ['value' => '/images/seller-profile-hero.jpg', 'group' => 'seo'],
            'seo_header_scripts' => ['value' => '', 'group' => 'seo'],

            // USER PROMPT: "yr idher koi html code na ho"
            // Homepage Hero & Filter Buttons Settings
            'hero_title' => ['value' => 'Find the right pet for your family.', 'group' => 'hero'],
            'hero_desc' => ['value' => 'Search pets by category, breed, location and price, then review the listing and seller before making contact.', 'group' => 'hero'],
            'hero_image' => ['value' => 'images/home-hero-image.png', 'group' => 'hero'],
            'hero_cta_text' => ['value' => 'Find a Pet', 'group' => 'hero'],
            'hero_filter_cat_label' => ['value' => 'PET CATEGORY', 'group' => 'hero'],
            'hero_filter_cat_placeholder' => ['value' => 'Any category', 'group' => 'hero'],
            'hero_filter_breed_label' => ['value' => 'BREED', 'group' => 'hero'],
            'hero_filter_breed_placeholder' => ['value' => 'Any breed', 'group' => 'hero'],
            'hero_filter_loc_label' => ['value' => 'LOCATION', 'group' => 'hero'],
            'hero_filter_loc_placeholder' => ['value' => 'Any location', 'group' => 'hero'],
            'hero_filter_price_label' => ['value' => 'PRICE', 'group' => 'hero'],
            'hero_filter_price_placeholder' => ['value' => 'Any price', 'group' => 'hero'],
            'hero_locations' => ['value' => 'Islamabad, Karachi, Lahore, Rawalpindi, Faisalabad, Multan, Sialkot, Peshawar, Gujranwala, Quetta', 'group' => 'hero'],

            // Site & General Settings
            'site_name' => ['value' => 'Pet Marketplace', 'group' => 'general'],
            'site_tagline' => ['value' => 'Buy & Sell Pets Responsibly', 'group' => 'general'],
            'site_top_notice' => ['value' => 'Buy responsibly. Verify the animal and seller before completing a transaction.', 'group' => 'general'],
            'site_support_email' => ['value' => 'support@petmarket.pk', 'group' => 'general'],
            'site_support_phone' => ['value' => '+92 300 1234567', 'group' => 'general'],
            'site_whatsapp' => ['value' => '+92 300 1234567', 'group' => 'general'],
            'site_city_default' => ['value' => 'Lahore', 'group' => 'general'],
            'site_currency' => ['value' => 'PKR', 'group' => 'general'],
            'site_auto_approve_listings' => ['value' => '0', 'group' => 'general'],
        ];

        foreach ($defaults as $key => $data) {
            static::firstOrCreate(['key' => $key], [
                'value' => $data['value'],
                'group' => $data['group'],
            ]);
        }

        Cache::forget('site_settings_cache');
    }
}
