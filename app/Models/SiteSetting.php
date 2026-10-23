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

    // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
    /**
     * Retrieve synchronized dynamic locations list for Home Hero & Category pages.
     */
    public static function getLocationsList(): array
    {
        return Cache::remember('site_locations_list', 1800, function () {
            $raw = static::get('hero_locations', 'Islamabad, Karachi, Lahore, Rawalpindi, Faisalabad, Multan, Sialkot, Peshawar, Gujranwala, Quetta');
            $cities = [];
            if (!empty($raw)) {
                $cities = array_values(array_filter(array_map('trim', explode(',', $raw))));
            }
            if (empty($cities)) {
                $cities = ['Islamabad', 'Karachi', 'Lahore', 'Rawalpindi', 'Faisalabad', 'Multan', 'Sialkot', 'Peshawar', 'Gujranwala', 'Quetta'];
            }

            // USER PROMPT: "when i add cities from admin panel they are added in every page but when i look at create liting page they are not shown there just add same logic there if add cities from admin panell they also show there"
            $rawLocSec = static::get('loc_sec_cities', '');
            if (!empty($rawLocSec)) {
                $locSecCities = array_values(array_filter(array_map('trim', explode(',', $rawLocSec))));
                $cityLookup = array_map('strtolower', $cities);
                foreach ($locSecCities as $c) {
                    $trimmed = trim((string) $c);
                    if (!empty($trimmed) && !in_array(strtolower($trimmed), $cityLookup)) {
                        $cities[] = $trimmed;
                        $cityLookup[] = strtolower($trimmed);
                    }
                }
            }

            try {
                if (class_exists(\App\Models\Listing::class)) {
                    $listingCities = \App\Models\Listing::live()->whereNotNull('city')->distinct()->pluck('city')->toArray();
                    $cityLookup = array_map('strtolower', $cities);
                    foreach ($listingCities as $c) {
                        $trimmed = trim((string) $c);
                        if (!empty($trimmed) && !in_array(strtolower($trimmed), $cityLookup)) {
                            $cities[] = $trimmed;
                            $cityLookup[] = strtolower($trimmed);
                        }
                    }
                }
            } catch (\Throwable $e) {
                // Graceful fallback to configured cities
            }

            return $cities;
        });
    }

    // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
    /**
     * Retrieve synchronized dynamic price range tiers for Home Hero & Category filters.
     */
    public static function getPriceRanges(): array
    {
        $currency = static::get('site_currency', 'PKR');
        $currPrefix = in_array($currency, ['PKR', 'Rs', 'Rs.']) ? 'Rs. ' : $currency . ' ';

        $raw = static::get('hero_price_ranges');
        if (!empty($raw)) {
            $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
            if (is_array($decoded) && !empty($decoded)) {
                return array_map(function ($item) use ($currPrefix) {
                    $rawLabel = (string) ($item['label'] ?? '');
                    $formattedLabel = str_replace('{curr}', $currPrefix, $rawLabel);
                    $min = isset($item['min']) && $item['min'] !== '' ? $item['min'] : '0';
                    $max = isset($item['max']) && $item['max'] !== '' ? $item['max'] : null;
                    $val = $item['val'] ?? ($max ? "{$min}-{$max}" : "{$min}+");

                    return [
                        'min' => $min,
                        'max' => $max,
                        'label' => $formattedLabel,
                        'val' => $val,
                    ];
                }, $decoded);
            }
        }

        // USER PROMPT: "yr price main sirf price or kuch na ho u ky saath words"
        // Default standard price tiers - pure price figures without extra words
        return [
            ['min' => '0', 'max' => '20000', 'label' => '0 - 20,000', 'val' => '0-20000'],
            ['min' => '20000', 'max' => '50000', 'label' => '20,000 - 50,000', 'val' => '20000-50000'],
            ['min' => '50000', 'max' => '100000', 'label' => '50,000 - 100,000', 'val' => '50000-100000'],
            ['min' => '100000', 'max' => null, 'label' => '100,000+', 'val' => '100000+'],
        ];
    }

    // USER PROMPT: "ni in ko bhi dynamic kro"
    /**
     * Retrieve dynamic quick links for Footer
     */
    public static function getQuickLinks(): array
    {
        $raw = static::get('footer_quick_links');
        if (!empty($raw)) {
            $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
            if (is_array($decoded) && !empty($decoded)) {
                return $decoded;
            }
        }

        return [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'About Us', 'url' => '/about'],
            ['label' => 'Contact Us', 'url' => '/contact'],
            ['label' => 'Categories', 'url' => '/category'],
            ['label' => 'Breeds', 'url' => '/breeds'],
        ];
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

            // USER PROMPT: "yr home hero main sir image heading or text ko dynamic kro btns ko dynamic ni krna hai"
            // Homepage Hero Settings (Headline, Description & Image only - Buttons are static)
            'hero_title' => ['value' => 'Find the right pet for your family.', 'group' => 'hero'],
            'hero_desc' => ['value' => 'Search pets by category, breed, location and price, then review the listing and seller before making contact.', 'group' => 'hero'],
            'hero_image' => ['value' => 'images/home-hero-image.png', 'group' => 'hero'],

            // USER PROMPT: "category page ka heroo section bhi dynamic kro"
            // Category Page Hero Settings (Headline, Description & Pets Collage Image)
            'category_hero_title' => ['value' => 'Browse Pet Listings', 'group' => 'category_hero'],
            'category_hero_desc' => ['value' => 'Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.', 'group' => 'category_hero'],
            'category_hero_image' => ['value' => 'images/category-hero-img.png', 'group' => 'category_hero'],
            'featured_hero_title' => ['value' => 'Featured Pet Listings', 'group' => 'category_hero'],
            'featured_hero_desc' => ['value' => 'Discover premium and featured pet listings from top verified sellers.', 'group' => 'category_hero'],

            // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
            // Dynamic Search Filters Configuration for Homepage Hero & Category Page
            'filter_cat_label' => ['value' => 'PET CATEGORY', 'group' => 'hero_filters'],
            'filter_cat_placeholder' => ['value' => 'Any category', 'group' => 'hero_filters'],
            'filter_breed_label' => ['value' => 'BREED', 'group' => 'hero_filters'],
            'filter_breed_placeholder' => ['value' => 'Any breed', 'group' => 'hero_filters'],
            'filter_loc_label' => ['value' => 'LOCATION', 'group' => 'hero_filters'],
            'filter_loc_placeholder' => ['value' => 'Any location', 'group' => 'hero_filters'],
            'filter_price_label' => ['value' => 'PRICE', 'group' => 'hero_filters'],
            'filter_price_placeholder' => ['value' => 'Any price', 'group' => 'hero_filters'],
            'filter_btn_text' => ['value' => 'Find a Pet', 'group' => 'hero_filters'],
            'hero_locations' => ['value' => 'Islamabad, Karachi, Lahore, Rawalpindi, Faisalabad, Multan, Sialkot, Peshawar, Gujranwala, Quetta', 'group' => 'hero_filters'],
            // USER PROMPT: "yr price main sirf price or kuch na ho u ky saath words"
            'hero_price_ranges' => [
                'value' => json_encode([
                    ['min' => '0', 'max' => '20000', 'label' => '0 - 20,000', 'val' => '0-20000'],
                    ['min' => '20000', 'max' => '50000', 'label' => '20,000 - 50,000', 'val' => '20000-50000'],
                    ['min' => '50000', 'max' => '100000', 'label' => '50,000 - 100,000', 'val' => '50000-100000'],
                    ['min' => '100000', 'max' => '', 'label' => '100,000+', 'val' => '100000+'],
                ]),
                'group' => 'hero_filters'
            ],

            // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
            // Homepage Browse by Pet Category Section Settings
            'home_cat_title' => ['value' => 'Browse by Pet Category', 'group' => 'home_categories'],
            'home_cat_subtitle' => ['value' => "Start your search by choosing the type of companion you're looking for.", 'group' => 'home_categories'],

            // USER PROMPT: "ya admin pannel home page main ya section dynamic kro"
            // Safety & Responsible Pet Ownership Section Settings
            'safety_title' => ['value' => 'Safety & Responsible', 'group' => 'safety'],
            'safety_title_highlight' => ['value' => 'Pet Ownership', 'group' => 'safety'],
            'safety_lead_bold' => ['value' => 'We promote safe pet transactions', 'group' => 'safety'],
            'safety_lead_text' => ['value' => 'and responsible ownership to help protect both pets and people.', 'group' => 'safety'],
            'safety_image' => ['value' => 'images/safety-responsible.png', 'group' => 'safety'],
            'safety_points' => [
                'value' => "Verify the pet’s health and vaccination details before buying.\nMeet the seller and pet in a safe location.\nNever send advance payment without proper verification.\nUnderstand the pet’s food, care, medical, and exercise needs.\nReport suspicious or misleading listings.",
                'group' => 'safety'
            ],

            // USER PROMPT: "footer to dynamic kro"
            // Dynamic Marketplace Footer Settings
            'footer_brand_title' => ['value' => 'Pet Marketplace', 'group' => 'footer'],
            'footer_brand_logo' => ['value' => 'images/Italic-text.png', 'group' => 'footer'],
            'footer_brand_desc' => ['value' => 'A trusted pet marketplace connecting responsible buyers, sellers, breeders, and pet businesses in one safe and easy-to-use platform.', 'group' => 'footer'],
            'footer_quick_links_title' => ['value' => 'Quick Links', 'group' => 'footer'],
            // USER PROMPT: "ni in ko bhi dynamic kro"
            'footer_quick_links' => [
                'value' => json_encode([
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'About Us', 'url' => '/about'],
                    ['label' => 'Contact Us', 'url' => '/contact'],
                    ['label' => 'Categories', 'url' => '/category'],
                    ['label' => 'Breeds', 'url' => '/breeds'],
                ]),
                'group' => 'footer'
            ],
            'footer_categories_title' => ['value' => 'Pet Categories', 'group' => 'footer'],
            'footer_contact_title' => ['value' => 'Contact & Support', 'group' => 'footer'],
            'footer_email' => ['value' => 'Support@petmarket.com', 'group' => 'footer'],
            'footer_phone' => ['value' => '+92 3100865765', 'group' => 'footer'],
            'footer_social_title' => ['value' => 'Follow Us:', 'group' => 'footer'],
            'footer_facebook_url' => ['value' => '#', 'group' => 'footer'],
            'footer_instagram_url' => ['value' => '#', 'group' => 'footer'],
            'footer_youtube_url' => ['value' => '#', 'group' => 'footer'],
            // USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main"
            // About Us - Section 1: Our Purpose
            'about_purpose_badge' => ['value' => 'OUR PURPOSE', 'group' => 'about'],
            'about_purpose_title' => ['value' => 'A marketplace built around better information, not just listings.', 'group' => 'about'],
            'about_purpose_desc1' => ['value' => 'Finding a pet is different from buying an ordinary classified item. Buyers need to understand the animal, its health information, seller details and long-term care requirements before making a decision.', 'group' => 'about'],
            'about_purpose_desc2' => ['value' => 'That is why the marketplace brings pet details, seller profiles, messaging, moderation and safety guidance into one consistent journey.', 'group' => 'about'],
            'about_purpose_points' => [
                'value' => "Clear breed, age, gender, price and location information.\nHealth and vaccination details where applicable.\nSeller information and marketplace messaging before contact.",
                'group' => 'about'
            ],
            'about_purpose_image' => ['value' => 'images/about-purpose.jpg', 'group' => 'about'],

            // About Us - Section 2: One Marketplace for Different Needs
            'about_marketplace_title' => ['value' => 'One marketplace for different pet-related needs.', 'group' => 'about'],
            'about_marketplace_image' => ['value' => 'images/about-dogs.jpg', 'group' => 'about'],
            'about_need_1_title' => ['value' => 'Individual pet owners', 'group' => 'about'],
            'about_need_1_desc' => ['value' => 'People who want to sell or responsibly rehome a pet through a structured listing.', 'group' => 'about'],
            'about_need_2_title' => ['value' => 'Pet buyers', 'group' => 'about'],
            'about_need_2_desc' => ['value' => 'Users looking for specific breeds, ages, genders, price ranges or locations.', 'group' => 'about'],
            'about_need_3_title' => ['value' => 'Breeders and pet businesses', 'group' => 'about'],
            'about_need_3_desc' => ['value' => 'Professional sellers that need profiles, listings and marketplace visibility.', 'group' => 'about'],
            'about_need_4_title' => ['value' => 'Platform moderators', 'group' => 'about'],
            'about_need_4_desc' => ['value' => 'Teams responsible for listings, reports, categories and marketplace quality.', 'group' => 'about'],

            // About Us - Section 3: Safer Interactions
            'about_safer_title' => ['value' => 'Safer interactions start with better information.', 'group' => 'about'],
            'about_safer_desc' => ['value' => 'Pet transactions require more care than a typical classified listing. That is why the platform keeps safety, moderation and responsible ownership visible throughout the experience.', 'group' => 'about'],
            'about_safer_points' => [
                'value' => "Verify the animal, seller, ownership and available health information.\nUse reporting tools for suspicious or misleading listings and users.\nKeep exact seller address private by default.\nReview local requirements and responsible ownership considerations before proceeding.",
                'group' => 'about'
            ],
            'about_safer_card_1_icon' => ['value' => 'fas fa-user-shield', 'group' => 'about'],
            'about_safer_card_1_title' => ['value' => 'Seller Profiles', 'group' => 'about'],
            'about_safer_card_1_desc' => ['value' => 'Buyers can review seller information, active listings and relevant verification status before making contact.', 'group' => 'about'],
            'about_safer_card_2_icon' => ['value' => 'fas fa-comments', 'group' => 'about'],
            'about_safer_card_2_title' => ['value' => 'Marketplace Messaging', 'group' => 'about'],
            'about_safer_card_2_desc' => ['value' => 'Users can communicate through the platform without automatically exposing private contact information.', 'group' => 'about'],
            'about_safer_card_3_icon' => ['value' => 'fas fa-flag', 'group' => 'about'],
            'about_safer_card_3_title' => ['value' => 'Reporting & Moderation', 'group' => 'about'],
            'about_safer_card_3_desc' => ['value' => 'Listings and users can be reported so marketplace moderators can review possible policy or safety concerns.', 'group' => 'about'],

            // Site & General Settings
            'site_name' => ['value' => 'Pet Marketplace', 'group' => 'general'],
            'site_tagline' => ['value' => 'Buy & Sell Pets Responsibly', 'group' => 'general'],
            'site_top_notice' => ['value' => 'Buy responsibly. Verify the animal and seller before completing a transaction.', 'group' => 'general'],
            'site_support_email' => ['value' => 'support@petmarket.pk', 'group' => 'general'],
            'site_support_phone' => ['value' => '+92 300 1234567', 'group' => 'general'],
            'site_whatsapp' => ['value' => '+92 300 1234567', 'group' => 'general'],
            'site_city_default' => ['value' => 'Lahore', 'group' => 'general'],
            // USER PROMPT: "jb koi seller listing bna dy pehly vo admin sy approve ho gy"
            'site_auto_approve_listings' => ['value' => '0', 'group' => 'general'],

            // USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly"
            'featured_sec_title' => ['value' => 'Featured Pets', 'group' => 'featured_pets'],
            'featured_sec_subtitle' => ['value' => 'Highlighted pet listings from sellers on the marketplace.', 'group' => 'featured_pets'],

            // USER PROMPT: "yr home page main in sections ko dynamic kro"
            // Homepage Promotional CTA Banner Settings
            'home_cta_title' => ['value' => 'One More Friend', 'group' => 'home_cta'],
            'home_cta_subtitle' => ['value' => 'Thousands More Fun!', 'group' => 'home_cta'],
            'home_cta_desc' => ['value' => 'Having a pet means you have more joy, a new friend, a happy person who will always be with you to have fun. We have 200+ different pets that can meet your needs!', 'group' => 'home_cta'],
            'home_cta_image' => ['value' => 'images/more-friend.png', 'group' => 'home_cta'],
            'home_cta_btn1_text' => ['value' => 'Browse Dogs', 'group' => 'home_cta'],
            'home_cta_btn1_link' => ['value' => '/category/dogs', 'group' => 'home_cta'],
            'home_cta_btn2_text' => ['value' => 'Browse Cats', 'group' => 'home_cta'],
            'home_cta_btn2_link' => ['value' => '/category/cats', 'group' => 'home_cta'],

            // Homepage Find Pets by Location Section Settings
            'loc_sec_title' => ['value' => 'Find Pets by Location', 'group' => 'home_locations'],
            'loc_sec_subtitle' => ['value' => 'Browse pets available in major cities and find listings closer to your location.', 'group' => 'home_locations'],
            'loc_sec_cities' => ['value' => 'Lahore, Faisalabad, Multan, Sialkot, Karachi, Peshawar, Islamabad', 'group' => 'home_locations'],
            'loc_sec_card_subtext' => ['value' => 'Browse listings', 'group' => 'home_locations'],
            'loc_sec_all_text' => ['value' => 'All Locations', 'group' => 'home_locations'],

            // USER PROMPT: "contact us ka ya section dynamic kro"
            // Contact Us Page - Contact & Support Section Settings
            'contact_title' => ['value' => 'Contact & Support', 'group' => 'contact'],
            'contact_desc' => ['value' => 'Use the details below or send us a message through the form.', 'group' => 'contact'],
            'contact_email_title' => ['value' => 'Email Support', 'group' => 'contact'],
            'contact_email' => ['value' => 'support@petmarket.com', 'group' => 'contact'],
            'contact_phone_title' => ['value' => 'Phone', 'group' => 'contact'],
            'contact_phone' => ['value' => '+92 310 0865755', 'group' => 'contact'],
            'contact_social_title' => ['value' => 'Follow Us', 'group' => 'contact'],
            'contact_facebook_url' => ['value' => '#', 'group' => 'contact'],
            'contact_instagram_url' => ['value' => '#', 'group' => 'contact'],
            'contact_youtube_url' => ['value' => '#', 'group' => 'contact'],
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
