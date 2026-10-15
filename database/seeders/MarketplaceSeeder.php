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
        // 1. Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@petmarket.pk'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password123'),
                'phone' => '03000000000',
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

        // 3. Listings for Ahmed Khan
        $listingsData = [
            // LIVE LISTINGS
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['cats']->id,
                'breed_id' => $breedMap['cats:persian-cat']->id,
                'breed_name' => 'Persian Cat',
                'title' => 'Pure Persian Punch Face Kitten',
                'slug' => 'pure-persian-punch-face-kitten',
                'description' => 'Super active, litter-trained pure Persian male kitten. 3.5 months old, snow-white fur, fully dewormed and first vaccination completed. Very friendly with children.',
                'price' => 38000,
                'is_negotiable' => true,
                'age_months' => 4,
                'gender' => 'male',
                'vaccinated' => true,
                'dewormed' => true,
                'health_certificate' => true,
                'city' => 'Lahore',
                'area' => 'DHA Phase 5',
                'status' => 'live',
                'is_featured' => true,
                'views_count' => 142,
                'image' => 'images/card_persian.jpg',
            ],
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['dogs']->id,
                'breed_id' => $breedMap['dogs:golden-retriever']->id,
                'breed_name' => 'Golden Retriever',
                'title' => 'Champion Line Golden Retriever Puppy',
                'slug' => 'champion-line-golden-retriever-puppy',
                'description' => 'Healthy, playful Golden Retriever male puppy. 2.5 months old, pedigree certified, vaccinated with medical card. Looking for a loving home.',
                'price' => 75000,
                'is_negotiable' => false,
                'age_months' => 3,
                'gender' => 'male',
                'vaccinated' => true,
                'dewormed' => true,
                'health_certificate' => true,
                'city' => 'Lahore',
                'area' => 'Gulberg III',
                'status' => 'live',
                'is_featured' => true,
                'views_count' => 280,
                'image' => 'images/pets/golden-retriever.jpg',
            ],
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['cats']->id,
                'breed_id' => $breedMap['cats:british-shorthair']->id,
                'breed_name' => 'British Shorthair',
                'title' => 'Silver Tabby British Shorthair Female',
                'slug' => 'silver-tabby-british-shorthair-female',
                'description' => 'Gorgeous silver shaded British Shorthair female. 5 months old, calm and gentle temperament. Clean ears, negative for mites, certified health card.',
                'price' => 60000,
                'is_negotiable' => true,
                'age_months' => 5,
                'gender' => 'female',
                'vaccinated' => true,
                'dewormed' => true,
                'health_certificate' => true,
                'city' => 'Lahore',
                'area' => 'Model Town',
                'status' => 'live',
                'is_featured' => false,
                'views_count' => 95,
                'image' => 'images/card_british.jpg',
            ],
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['dogs']->id,
                'breed_id' => $breedMap['dogs:german-shepherd']->id,
                'breed_name' => 'German Shepherd',
                'title' => 'Long Coat German Shepherd Female Puppy',
                'slug' => 'long-coat-german-shepherd-female-puppy',
                'description' => 'Heavy bone structure, dark mask, double coat German Shepherd puppy. 3 months old, active guard drive and great companion.',
                'price' => 55000,
                'is_negotiable' => true,
                'age_months' => 3,
                'gender' => 'female',
                'vaccinated' => true,
                'dewormed' => true,
                'health_certificate' => false,
                'city' => 'Lahore',
                'area' => 'Johar Town',
                'status' => 'live',
                'is_featured' => false,
                'views_count' => 210,
                'image' => 'images/card_gsd.jpg',
            ],

            // SOLD LISTINGS
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['dogs']->id,
                'breed_id' => $breedMap['dogs:shih-tzu']->id,
                'breed_name' => 'Shih Tzu',
                'title' => 'Tricolor Toy Shih Tzu Puppy',
                'slug' => 'tricolor-toy-shih-tzu-puppy',
                'description' => 'Playful tricolor Shih Tzu puppy. Sold to a loving family in Lahore.',
                'price' => 45000,
                'is_negotiable' => false,
                'age_months' => 2,
                'gender' => 'male',
                'vaccinated' => true,
                'dewormed' => true,
                'health_certificate' => true,
                'city' => 'Lahore',
                'area' => 'DHA Phase 3',
                'status' => 'sold',
                'is_featured' => false,
                'views_count' => 412,
                'image' => 'images/card_shihtzu.jpg',
            ],
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['birds']->id,
                'breed_id' => $breedMap['birds:raw-parrot']->id,
                'breed_name' => 'Raw Parrot',
                'title' => 'Tamed Hand-Fed Raw Parrot',
                'slug' => 'tamed-hand-fed-raw-parrot',
                'description' => 'Talking raw parrot, hand-fed from 15 days. Successfully handed over to buyer.',
                'price' => 32000,
                'is_negotiable' => false,
                'age_months' => 12,
                'gender' => 'male',
                'vaccinated' => false,
                'dewormed' => true,
                'health_certificate' => false,
                'city' => 'Lahore',
                'area' => 'Cantt',
                'status' => 'sold',
                'is_featured' => false,
                'views_count' => 380,
                'image' => 'images/card_parrot.jpg',
            ],
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['rabbits']->id,
                'breed_id' => $breedMap['rabbits:lionhead-rabbit']->id,
                'breed_name' => 'Lionhead Rabbit',
                'title' => 'White Lionhead Bunny Pair',
                'slug' => 'white-lionhead-bunny-pair',
                'description' => 'Gentle lionhead bunnies. Completed sales history.',
                'price' => 8000,
                'is_negotiable' => false,
                'age_months' => 4,
                'gender' => 'pair',
                'vaccinated' => false,
                'dewormed' => true,
                'health_certificate' => false,
                'city' => 'Lahore',
                'area' => 'Bahria Town',
                'status' => 'sold',
                'is_featured' => false,
                'views_count' => 150,
                'image' => 'images/card_rabbit.jpg',
            ],

            // PENDING LISTING
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['cats']->id,
                'breed_id' => $breedMap['cats:persian-cat']->id,
                'breed_name' => 'Persian Cat',
                'title' => 'Doll Face Semi-Punch Persian Female',
                'slug' => 'doll-face-semi-punch-persian-female',
                'description' => 'Awaiting admin verification before going live.',
                'price' => 28000,
                'is_negotiable' => true,
                'age_months' => 3,
                'gender' => 'female',
                'vaccinated' => true,
                'dewormed' => true,
                'health_certificate' => false,
                'city' => 'Lahore',
                'area' => 'Wapda Town',
                'status' => 'pending',
                'is_featured' => false,
                'views_count' => 0,
                'image' => 'images/card_persian.jpg',
            ],

            // REJECTED LISTING
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['dogs']->id,
                'breed_id' => $breedMap['dogs:pug']->id,
                'breed_name' => 'Pug',
                'title' => 'Fawn Color Pug Male',
                'slug' => 'fawn-color-pug-male',
                'description' => 'Images blurry. Re-upload needed.',
                'price' => 35000,
                'is_negotiable' => false,
                'age_months' => 6,
                'gender' => 'male',
                'vaccinated' => true,
                'dewormed' => true,
                'health_certificate' => false,
                'city' => 'Lahore',
                'area' => 'Iqbal Town',
                'status' => 'rejected',
                'rejection_reason' => 'Please provide clearer, high-resolution original photos of the pet.',
                'is_featured' => false,
                'views_count' => 12,
                'image' => 'images/pets/golden-retriever.jpg',
            ],

            // DRAFT LISTING
            [
                'user_id' => $seller->id,
                'category_id' => $categoryMap['cats']->id,
                'breed_id' => $breedMap['cats:siamese-cat']->id,
                'breed_name' => 'Siamese Cat',
                'title' => 'Seal Point Siamese Kitten',
                'slug' => 'seal-point-siamese-kitten',
                'description' => 'Draft ad saved by seller.',
                'price' => 25000,
                'is_negotiable' => true,
                'age_months' => 2,
                'gender' => 'female',
                'vaccinated' => false,
                'dewormed' => true,
                'health_certificate' => false,
                'city' => 'Lahore',
                'area' => 'Faisal Town',
                'status' => 'draft',
                'is_featured' => false,
                'views_count' => 0,
                'image' => 'images/card_british.jpg',
            ],
        ];

        $createdListings = [];
        foreach ($listingsData as $lData) {
            $imagePath = $lData['image'];
            unset($lData['image']);

            $listing = Listing::firstOrCreate(['slug' => $lData['slug']], $lData);
            $createdListings[] = $listing;

            ListingImage::firstOrCreate(
                ['listing_id' => $listing->id, 'image_path' => $imagePath],
                [
                    'thumb_path' => $imagePath,
                    'is_primary' => true,
                    'sort_order' => 1,
                ]
            );
        }

        // 4. Conversation between Buyer (Usman Ali) and Seller (Ahmed Khan)
        $persianListing = $createdListings[0]; // Pure Persian Punch Face Kitten
        $conversation = Conversation::firstOrCreate(
            ['listing_id' => $persianListing->id, 'buyer_id' => $buyer->id],
            [
                'seller_id' => $seller->id,
                'last_message_at' => now(),
            ]
        );

        // Messages in conversation
        Message::firstOrCreate(
            ['conversation_id' => $conversation->id, 'body' => 'Assalam-o-Alaikum! Is this Persian kitten still available?'],
            [
                'sender_id' => $buyer->id,
                'type' => 'text',
                'is_read' => true,
                'created_at' => now()->subMinutes(30),
            ]
        );

        Message::firstOrCreate(
            ['conversation_id' => $conversation->id, 'body' => 'Walaikum Assalam! Yes, brother, it is available. You can visit DHA Phase 5 to inspect in person.'],
            [
                'sender_id' => $seller->id,
                'type' => 'text',
                'is_read' => true,
                'created_at' => now()->subMinutes(20),
            ]
        );

        Message::firstOrCreate(
            ['conversation_id' => $conversation->id, 'body' => 'I would like to offer PKR 35,000. Can we close the deal?'],
            [
                'sender_id' => $buyer->id,
                'type' => 'offer',
                'offer_amount' => 35000,
                'offer_status' => 'pending',
                'is_read' => false,
                'created_at' => now()->subMinutes(5),
            ]
        );

        // 5. Favorites (Intentionally left empty so buyers manage their own favorites)

        // 6. Review for Ahmed Khan
        Review::firstOrCreate(
            ['reviewer_id' => $buyer->id, 'seller_id' => $seller->id, 'listing_id' => $createdListings[4]->id], // Sold Shih Tzu
            [
                'rating' => 5,
                'comment' => 'Very genuine seller! The puppy was completely healthy and vaccinated. Smooth transaction without any issues.',
            ]
        );
    }
}
