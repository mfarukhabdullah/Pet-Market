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
            [
                'name' => 'Dogs',
                'slug' => 'dogs',
                'icon' => 'fa-solid fa-dog',
                'image' => 'images/cat_dog.jpg',
                'sort_order' => 1,
                'breeds' => [
                    ['name' => 'German Shepherd', 'slug' => 'german-shepherd', 'image' => 'images/german_shepherd.jpg'],
                    ['name' => 'Golden Retriever', 'slug' => 'golden-retriever', 'image' => 'images/golden_retriever.jpg'],
                    ['name' => 'Shih Tzu', 'slug' => 'shih-tzu', 'image' => 'images/card_shihtzu.jpg'],
                    ['name' => 'Pug', 'slug' => 'pug'],
                    ['name' => 'Rottweiler', 'slug' => 'rottweiler'],
                    ['name' => 'Siberian Husky', 'slug' => 'siberian-husky'],
                ]
            ],
            [
                'name' => 'Cats',
                'slug' => 'cats',
                'icon' => 'fa-solid fa-cat',
                'image' => 'images/cat_cat.jpg',
                'sort_order' => 2,
                'breeds' => [
                    ['name' => 'Persian Cat', 'slug' => 'persian-cat', 'image' => 'images/persian.jpg'],
                    ['name' => 'British Shorthair', 'slug' => 'british-shorthair', 'image' => 'images/british_shorthair.jpg'],
                    ['name' => 'Siamese Cat', 'slug' => 'siamese-cat'],
                    ['name' => 'Maine Coon', 'slug' => 'maine-coon'],
                    ['name' => 'Scottish Fold', 'slug' => 'scottish-fold'],
                ]
            ],
            [
                'name' => 'Birds',
                'slug' => 'birds',
                'icon' => 'fa-solid fa-dove',
                'image' => 'images/cat_bird.jpg',
                'sort_order' => 3,
                'breeds' => [
                    ['name' => 'Raw Parrot', 'slug' => 'raw-parrot', 'image' => 'images/card_parrot.jpg'],
                    ['name' => 'Cockatiel', 'slug' => 'cockatiel'],
                    ['name' => 'Lovebird', 'slug' => 'lovebird'],
                    ['name' => 'Macaw', 'slug' => 'macaw'],
                ]
            ],
            [
                'name' => 'Rabbits',
                'slug' => 'rabbits',
                'icon' => 'fa-solid fa-paw',
                'image' => 'images/card_rabbit.jpg',
                'sort_order' => 4,
                'breeds' => [
                    ['name' => 'Netherland Dwarf', 'slug' => 'netherland-dwarf'],
                    ['name' => 'Lionhead Rabbit', 'slug' => 'lionhead-rabbit'],
                ]
            ],
            [
                'name' => 'Fish',
                'slug' => 'fish',
                'icon' => 'fa-solid fa-fish',
                'image' => 'images/cat_fish.jpg',
                'sort_order' => 5,
                'breeds' => [
                    ['name' => 'Betta Fish', 'slug' => 'betta-fish', 'image' => 'images/cat_fish.jpg'],
                    ['name' => 'Discus Fish', 'slug' => 'discus-fish', 'image' => 'images/cat_fish.jpg'],
                    ['name' => 'Goldfish', 'slug' => 'goldfish'],
                    ['name' => 'Guppy', 'slug' => 'guppy'],
                ]
            ],
            [
                'name' => 'Reptiles',
                'slug' => 'reptiles',
                'icon' => 'fa-solid fa-worm',
                'image' => 'images/cat_reptile.jpg',
                'sort_order' => 6,
                'breeds' => [
                    ['name' => 'Leopard Gecko', 'slug' => 'leopard-gecko', 'image' => 'images/cat_reptile.jpg'],
                    ['name' => 'Bearded Dragon', 'slug' => 'bearded-dragon', 'image' => 'images/cat_reptile.jpg'],
                    ['name' => 'Red-Eared Slider Turtle', 'slug' => 'red-eared-slider-turtle', 'image' => 'images/cat_reptile.jpg'],
                    ['name' => 'Ball Python', 'slug' => 'ball-python'],
                ]
            ],
            [
                'name' => 'Horses & Farm',
                'slug' => 'horses-farm',
                'icon' => 'fa-solid fa-horse',
                'image' => 'images/cat_horse.jpg',
                'sort_order' => 7,
                'breeds' => [
                    ['name' => 'Arabian Horse', 'slug' => 'arabian-horse', 'image' => 'images/cat_horse.jpg'],
                    ['name' => 'Thoroughbred', 'slug' => 'thoroughbred', 'image' => 'images/cat_horse.jpg'],
                    ['name' => 'Pygmy Goat', 'slug' => 'pygmy-goat', 'image' => 'images/cat_horse.jpg'],
                    ['name' => 'Miniature Horse', 'slug' => 'miniature-horse'],
                ]
            ],
            [
                'name' => 'Exotic Pets',
                'slug' => 'exotic',
                'icon' => 'fa-solid fa-feather',
                'image' => 'images/card_parrot.jpg',
                'sort_order' => 8,
                'breeds' => [
                    ['name' => 'African Grey Parrot', 'slug' => 'african-grey-parrot', 'image' => 'images/pets/african-grey.jpg'],
                    ['name' => 'Ringneck Parakeet', 'slug' => 'ringneck-parakeet', 'image' => 'images/card_parrot.jpg'],
                    ['name' => 'Sugar Glider', 'slug' => 'sugar-glider'],
                    ['name' => 'Chinchilla', 'slug' => 'chinchilla'],
                ]
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
