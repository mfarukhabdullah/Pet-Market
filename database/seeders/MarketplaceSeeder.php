<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Breed;
use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Review;
use App\Models\Favorite;

class MarketplaceSeeder extends Seeder
{
    public function run()
    {
        // USER PROMPT: "yr admin pannel ka loginpassword bnao login tum bnao petmarket@gmail.com password: pet@123"
        // 1. Users
        $admin = User::updateOrCreate(
            ['email' => 'petmarket@gmail.com'],
            [
                'name' => 'PetMarket Admin',
                'password' => Hash::make('pet@123'),
                'phone' => '03001112233',
                'phone_verified_at' => now(),
                'role' => 'admin',
                'seller_type' => 'business',
                'city' => 'Lahore',
                'trust_score' => 100,
                'is_verified' => true,
                'badge_type' => 'Platform Admin',
            ]
        );

        $seller = User::firstOrCreate(
            ['email' => 'seller@petmarket.pk'],
            [
                'name' => 'Ahmed Khan',
                'password' => Hash::make('password123'),
                'phone' => '03001234567',
                'phone_verified_at' => now(),
                'avatar' => 'images/seller-avatar.jpg',
                'role' => 'seller',
                'seller_type' => 'individual',
                'city' => 'Lahore',
                'address' => 'DHA Phase 5, Lahore',
                'bio' => 'Passionate pet owner and ethical hobby breeder based in Lahore. All pets are home-raised, vet-checked, and vaccinated.',
                'trust_score' => 95,
                'is_verified' => true,
                'badge_type' => 'Verified Seller',
            ]
        );

        $buyer = User::firstOrCreate(
            ['email' => 'buyer@petmarket.pk'],
            [
                'name' => 'Usman Ali',
                'password' => Hash::make('password123'),
                'phone' => '03219876543',
                'phone_verified_at' => now(),
                'role' => 'buyer',
                'seller_type' => 'individual',
                'city' => 'Lahore',
                'trust_score' => 60,
                'is_verified' => true,
            ]
        );

        // 2. Categories & Breeds
        $categoriesData = [
            // USER PROMPT: "admin main defaut main kuch ni hona chahye jo add krin bs vo ho"
            [
                'name' => 'Dogs',
                'slug' => 'dogs',
                'icon' => 'fa-solid fa-dog',
                'image' => 'images/cat_dog.jpg',
                'sort_order' => 1,
                'breeds' => []
            ],
            [
                'name' => 'Cats',
                'slug' => 'cats',
                'icon' => 'fa-solid fa-cat',
                'image' => 'images/cat_cat.jpg',
                'sort_order' => 2,
                'breeds' => []
            ],
        ];

        $categoryMap = [];
        $breedMap = [];

        foreach ($categoriesData as $cData) {
            $breeds = $cData['breeds'];
            unset($cData['breeds']);
            
            $cat = Category::firstOrCreate(['slug' => $cData['slug']], $cData);
            $categoryMap[$cat->slug] = $cat;

            foreach ($breeds as $bData) {
                $bData['category_id'] = $cat->id;
                $breed = Breed::firstOrCreate(
                    ['category_id' => $cat->id, 'slug' => $bData['slug']],
                    $bData
                );
                $breedMap[$cat->slug . ':' . $breed->slug] = $breed;
            }
        }
        // USER PROMPT: "yr mera ya flow ho ga ab user ay ga vo signup kry ga agr vo pet  sell jo krta hao vo show hon is ky ilawa koi dummy data show pets na hon jo vo listing bany vohi sirf show hon"
        // NO dummy listings seeded - Only real user-created listings will be shown on the platform.
    }
}
