<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Category;
use App\Models\Breed;
use App\Models\Listing;
use App\Models\ListingImage;

// USER PROMPT: "yr br bred animal ki apni immage seeder bna kr listing main lgao"
class BreedListingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Assigns every breed animal its own authentic image in the listings.
     *
     * @return void
     */
    public function run()
    {
        // 1. Ensure German Shepherd breed has its own image set in breeds table
        $gsdBreed = Breed::where('slug', 'germen-shepherd')->first();
        if ($gsdBreed && empty($gsdBreed->image)) {
            $gsdBreed->update(['image' => 'images/pets/german-shepherd.jpg']);
        }

        // USER PROMPT: "yr br bred animal ki apni immage seeder bna kr listing main lgao"
        // 2. Soft-delete legacy dummy listings so only authentic breed listings appear
        Listing::whereIn('slug', ['persion-cat', 'german-shephard', 'extreme-punch-face-cream-persian-male-cat'])->delete();



        // 3. Get or create primary sellers
        $seller = User::where('role', 'seller')->first();
        if (!$seller) {
            $seller = User::firstOrCreate(
                ['email' => 'seller@petmarket.pk'],
                [
                    'name' => 'Ahmed Khan',
                    'password' => bcrypt('password123'),
                    'phone' => '03001234567',
                    'phone_verified_at' => now(),
                    'role' => 'seller',
                    'seller_type' => 'individual',
                    'city' => 'Lahore',
                    'address' => 'DHA Phase 5, Lahore',
                    'trust_score' => 95,
                    'is_verified' => true,
                    'badge_type' => 'Verified Seller',
                ]
            );
        }

        $sellerAlt = User::where('id', '!=', $seller->id)->whereIn('role', ['seller', 'buyer', 'admin'])->first();
        if (!$sellerAlt) {
            $sellerAlt = $seller;
        }

        // 4. Curated breed listings where every single animal has its OWN breed image
        $breedListingsData = [
            // Breed: Germen Shepherd (Dogs)
            'germen-shepherd' => [
                [
                    'title' => 'Champion Pedigree German Shepherd Male Puppy',
                    'slug' => 'champion-pedigree-german-shepherd-male-puppy',
                    'description' => "Exceptional purebred German Shepherd puppy from imported show-line parents. Extremely intelligent, alert, active, and family friendly. Fully vaccinated with complete veterinary record card. High bone density, dark black & tan pigment, and deep chest. Ideal for family companionship, guard training, or show competition.",
                    'price' => 45000,
                    'is_negotiable' => true,
                    'age_months' => 3,
                    'gender' => 'male',
                    'color' => 'Black & Tan',
                    'city' => 'Lahore',
                    'area' => 'DHA Phase 5',
                    'has_papers' => true,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => true,
                    'no_health_description' => false,
                    'is_featured' => true,
                    'created_minutes_ago' => 50,
                    'images' => [
                        ['path' => 'images/pets/german-shepherd.jpg', 'is_primary' => true],
                        ['path' => 'images/german_shepherd.jpg', 'is_primary' => false],
                        ['path' => 'images/card_gsd.jpg', 'is_primary' => false],
                    ],
                ],
                [
                    'title' => 'Trained Long Coat German Shepherd Female',
                    'slug' => 'trained-long-coat-german-shepherd-female',
                    'description' => "Gorgeous long coat German Shepherd female, 14 months old. Well-socialized with children and other pets, basic obedience trained (sit, stay, heel, recall). Very gentle nature with strong protective instincts. Fully vaccinated and dewormed on schedule with veterinary record.",
                    'price' => 65000,
                    'is_negotiable' => false,
                    'age_months' => 14,
                    'gender' => 'female',
                    'color' => 'Sable Red & Black',
                    'city' => 'Islamabad',
                    'area' => 'F-10 Markaz',
                    'has_papers' => true,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => true,
                    'no_health_description' => false,
                    'is_featured' => false,
                    'created_minutes_ago' => 8,
                    'images' => [
                        ['path' => 'images/card_gsd.jpg', 'is_primary' => true],
                        ['path' => 'images/pets/german-shepherd.jpg', 'is_primary' => false],
                    ],
                ],
            ],

            // Breed: persion cat (Cats) - Uses authentic pure white Persian Cat images
            'persion-cat' => [
                [
                    'title' => 'Doll Face Triple Coat White Persian Kitten',
                    'slug' => 'doll-face-triple-coat-white-persian-kitten',
                    'description' => "Adorable pure white Persian kitten with striking blue-green eyes. Triple coat, very fluffy, playful and litter-trained. Raised indoors in a clean, hygienic home environment. Eating royal canin mother & babycat dry and wet food. Vaccinated and dewormed with medical card.",
                    'price' => 35000,
                    'is_negotiable' => true,
                    'age_months' => 2,
                    'gender' => 'female',
                    'color' => 'Pure Snow White',
                    'city' => 'Lahore',
                    'area' => 'Gulberg III',
                    'has_papers' => false,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => true,
                    'no_health_description' => false,
                    'is_featured' => true,
                    'created_minutes_ago' => 45,
                    'images' => [
                        ['path' => 'uploads/breeds/breed_1792478872_6ad70e9832fde.webp', 'is_primary' => true],
                        ['path' => 'images/persian.jpg', 'is_primary' => false],
                    ],
                ],
                [
                    'title' => 'Fluffy Show Quality White Persian Cat',
                    'slug' => 'fluffy-show-quality-white-persian-cat',
                    'description' => "Magnificent purebred white Persian cat with lush, dense coat and calm regal personality. 10 months old, heavy bone structure, huge fluffy tail, extremely gentle and affectionate lap cat. Fully vaccinated, dewormed, and litter box trained. Perfect companion for cat lovers.",
                    'price' => 42000,
                    'is_negotiable' => false,
                    'age_months' => 10,
                    'gender' => 'male',
                    'color' => 'Snow White',
                    'city' => 'Karachi',
                    'area' => 'Clifton Block 4',
                    'has_papers' => false,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => true,
                    'no_health_description' => false,
                    'is_featured' => false,
                    'created_minutes_ago' => 7,
                    'images' => [
                        ['path' => 'images/persian.jpg', 'is_primary' => true],
                        ['path' => 'uploads/breeds/breed_1792478872_6ad70e9832fde.webp', 'is_primary' => false],
                    ],
                ],
            ],

            // Breed: star-fish (Fish)
            'star-fish' => [
                [
                    'title' => 'Healthy Marine Chocolate Chip Starfish',
                    'slug' => 'healthy-marine-chocolate-chip-starfish',
                    'description' => "Healthy and active Chocolate Chip Starfish (Nidorellia armata) for mature saltwater reef or marine aquariums. Beautiful distinct horn-like knobs, active scavenger that keeps the sand bed clean. Acclimated to standard marine parameters (Salinity 1.025, Temp 25C). Eats frozen shrimp and fish flakes.",
                    'price' => 6500,
                    'is_negotiable' => false,
                    'age_months' => 6,
                    'gender' => 'unknown',
                    'color' => 'Orange & Black Knobs',
                    'city' => 'Karachi',
                    'area' => 'Defense Phase 2',
                    'has_papers' => false,
                    'vaccinated' => false,
                    'dewormed' => false,
                    'health_certificate' => false,
                    'no_health_description' => true,
                    'is_featured' => false,
                    'created_minutes_ago' => 4,
                    'images' => [
                        ['path' => 'uploads/breeds/breed_1792647777_6ad9a26115a73.jfif', 'is_primary' => true],
                        ['path' => 'images/pets/starfish-reef.jpg', 'is_primary' => false],
                    ],
                ],
                [
                    'title' => 'Vibrant Red Reef Starfish for Marine Aquarium',
                    'slug' => 'vibrant-red-reef-starfish-for-marine-aquarium',
                    'description' => "Stunning bright red marine starfish for saltwater reef tanks. Peaceful reef-safe species, constantly active across rocks and glass. Healthy water acclimatized, vibrant pigmentation, fully intact arms with strong movement. Ideal for reef enthusiasts.",
                    'price' => 8500,
                    'is_negotiable' => true,
                    'age_months' => 8,
                    'gender' => 'unknown',
                    'color' => 'Vivid Red Orange',
                    'city' => 'Lahore',
                    'area' => 'Model Town',
                    'has_papers' => false,
                    'vaccinated' => false,
                    'dewormed' => false,
                    'health_certificate' => false,
                    'no_health_description' => true,
                    'is_featured' => false,
                    'created_minutes_ago' => 14,
                    'images' => [
                        ['path' => 'images/pets/starfish-reef.jpg', 'is_primary' => true],
                        ['path' => 'uploads/breeds/breed_1792647777_6ad9a26115a73.jfif', 'is_primary' => false],
                    ],
                ],
            ],

            // Breed: the-friesian (Horse)
            'the-friesian' => [
                [
                    'title' => 'Royal Black Friesian Stallion with Long Mane',
                    'slug' => 'royal-black-friesian-stallion-with-long-mane',
                    'description' => "Breathtaking purebred Friesian stallion with magnificent long wavy mane, heavy feathering on fetlocks, and high-stepping elegant trot. 4 years old, fully saddle broken, well trained for dressage, riding, and carriage driving. Calm temperament, vetted sound with clean x-rays and international breed passport.",
                    'price' => 850000,
                    'is_negotiable' => true,
                    'age_months' => 48,
                    'gender' => 'male',
                    'color' => 'Jet Black',
                    'city' => 'Lahore',
                    'area' => 'Bedian Road Farmhouses',
                    'has_papers' => true,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => true,
                    'no_health_description' => false,
                    'is_featured' => true,
                    'created_minutes_ago' => 40,
                    'images' => [
                        ['path' => 'images/pets/friesian-stallion.jpg', 'is_primary' => true],
                        ['path' => 'uploads/breeds/breed_1792648104_6ad9a3a88f27f.jfif', 'is_primary' => false],
                    ],
                ],
                [
                    'title' => 'Trained Friesian Sport Mare for Riding',
                    'slug' => 'trained-friesian-sport-mare-for-riding',
                    'description' => "Stunning 3-year-old Friesian mare with graceful movement and gentle disposition. Experienced with trail riding, arena dressage, and parade shows. Regular farrier care, up-to-date on all vaccinations and dewormers. Microchipped with certified pedigree papers.",
                    'price' => 750000,
                    'is_negotiable' => false,
                    'age_months' => 36,
                    'gender' => 'female',
                    'color' => 'Deep Pitch Black',
                    'city' => 'Rawalpindi',
                    'area' => 'Bahria Town Phase 7',
                    'has_papers' => true,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => true,
                    'no_health_description' => false,
                    'is_featured' => false,
                    'created_minutes_ago' => 6,
                    'images' => [
                        ['path' => 'uploads/breeds/breed_1792648104_6ad9a3a88f27f.jfif', 'is_primary' => true],
                        ['path' => 'images/pets/friesian-stallion.jpg', 'is_primary' => false],
                    ],
                ],
            ],

            // Breed: ball-python (Reptile)
            'ball-python' => [
                [
                    'title' => 'Pastel Enchi Royal Ball Python',
                    'slug' => 'pastel-enchi-royal-ball-python',
                    'description' => "Captive-bred Pastel Enchi designer morph Ball Python. 8 months old, feeding consistently on frozen-thawed hopper mice every 7 days. Perfect sheds, docile and easy to handle, never strikes. Comes with complete care guide and feeding logs. Ideal pet reptile for beginners or morph breeders.",
                    'price' => 28000,
                    'is_negotiable' => true,
                    'age_months' => 8,
                    'gender' => 'male',
                    'color' => 'Golden Yellow & Dark Caramel',
                    'city' => 'Islamabad',
                    'area' => 'G-11',
                    'has_papers' => false,
                    'vaccinated' => false,
                    'dewormed' => true,
                    'health_certificate' => false,
                    'no_health_description' => false,
                    'is_featured' => false,
                    'created_minutes_ago' => 2,
                    'images' => [
                        ['path' => 'images/pets/ball-python-morph.jpg', 'is_primary' => true],
                        ['path' => 'uploads/breeds/breed_1792663698_6ad9e09222156.jfif', 'is_primary' => false],
                    ],
                ],
                [
                    'title' => 'Tame Normal Pattern Ball Python Sub-Adult',
                    'slug' => 'tame-normal-pattern-ball-python-sub-adult',
                    'description' => "Very calm and friendly sub-adult Ball Python female. 18 months old, approximately 3 feet in length. Very docile, loves being held, sheds in single clean pieces without issue. Feeding aggressively on small rats. Healthy weight and clear scales.",
                    'price' => 22000,
                    'is_negotiable' => false,
                    'age_months' => 18,
                    'gender' => 'female',
                    'color' => 'Classic Brown & Gold Mosaic',
                    'city' => 'Lahore',
                    'area' => 'Johar Town',
                    'has_papers' => false,
                    'vaccinated' => false,
                    'dewormed' => true,
                    'health_certificate' => false,
                    'no_health_description' => false,
                    'is_featured' => false,
                    'created_minutes_ago' => 12,
                    'images' => [
                        ['path' => 'uploads/breeds/breed_1792663698_6ad9e09222156.jfif', 'is_primary' => true],
                        ['path' => 'images/pets/ball-python-morph.jpg', 'is_primary' => false],
                    ],
                ],
            ],

            // Breed: fantail-pigeon (Birds)
            'fantail-pigeon' => [
                [
                    'title' => 'Exhibition Quality Pure White Fantail Pigeon Pair',
                    'slug' => 'exhibition-quality-pure-white-fantail-pigeon-pair',
                    'description' => "Breeder pair of pure milk-white Indian Fantail Pigeons with full 360-degree fan tails (36+ feathers) and chest out posture. Healthy, active, and proven breeding pair. Fed with premium multiseed mix, mineral grit, and vitamins. Disease-free and vaccinated against PMV.",
                    'price' => 12000,
                    'is_negotiable' => true,
                    'age_months' => 12,
                    'gender' => 'pair',
                    'color' => 'Pure White',
                    'city' => 'Faisalabad',
                    'area' => 'Madina Town',
                    'has_papers' => false,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => false,
                    'no_health_description' => false,
                    'is_featured' => false,
                    'created_minutes_ago' => 1,
                    'images' => [
                        ['path' => 'images/pets/fantail-pigeon-white.jpg', 'is_primary' => true],
                        ['path' => 'uploads/breeds/breed_1792663856_6ad9e130d8684.jfif', 'is_primary' => false],
                    ],
                ],
                [
                    'title' => 'Show Line White Fantail Cock with Heavy Fan',
                    'slug' => 'show-line-white-fantail-cock-with-heavy-fan',
                    'description' => "Show standard male Fantail pigeon with majestic upright display, circular tail feathers, and clean foot feathering. Very active cooing and display behavior. Perfect addition for bird lovers and fancy pigeon fanciers. Ready for upcoming bird shows.",
                    'price' => 7500,
                    'is_negotiable' => false,
                    'age_months' => 9,
                    'gender' => 'male',
                    'color' => 'Snow White',
                    'city' => 'Lahore',
                    'area' => 'Samanabad',
                    'has_papers' => false,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => false,
                    'no_health_description' => false,
                    'is_featured' => false,
                    'created_minutes_ago' => 11,
                    'images' => [
                        ['path' => 'uploads/breeds/breed_1792663856_6ad9e130d8684.jfif', 'is_primary' => true],
                        ['path' => 'images/pets/fantail-pigeon-white.jpg', 'is_primary' => false],
                    ],
                ],
            ],

            // Breed: syrian-hamster (Small Pets)
            'syrian-hamster' => [
                [
                    'title' => 'Tame Golden Syrian Hamster with Accessories',
                    'slug' => 'tame-golden-syrian-hamster-with-accessories',
                    'description' => "Super friendly and hand-tame golden brown Syrian Hamster (Teddy Bear Hamster). Extremely cute, loves sitting in your hands and eating seeds. Never bites, very active on wheel during evening hours. Raised indoors with proper enrichment. Perfect friendly pet for kids and families.",
                    'price' => 3500,
                    'is_negotiable' => false,
                    'age_months' => 3,
                    'gender' => 'male',
                    'color' => 'Golden Brown & White',
                    'city' => 'Lahore',
                    'area' => 'Cantt',
                    'has_papers' => false,
                    'vaccinated' => false,
                    'dewormed' => false,
                    'health_certificate' => false,
                    'no_health_description' => true,
                    'is_featured' => false,
                    'created_minutes_ago' => 3,
                    'images' => [
                        ['path' => 'images/pets/syrian-hamster-golden.jpg', 'is_primary' => true],
                        ['path' => 'uploads/breeds/breed_1792663993_6ad9e1b9299a2.jfif', 'is_primary' => false],
                    ],
                ],
                [
                    'title' => 'Fluffy Longhair Syrian Hamster Female',
                    'slug' => 'fluffy-longhair-syrian-hamster-female',
                    'description' => "Sweet long-haired Syrian hamster female, 2.5 months old. Thick healthy coat, bright eyes, very clean and energetic. Eating high-protein seed blend, fresh veggies, and oats. Enjoys running in transparent play ball and tunnel toys.",
                    'price' => 4000,
                    'is_negotiable' => true,
                    'age_months' => 2,
                    'gender' => 'female',
                    'color' => 'Honey Cream',
                    'city' => 'Islamabad',
                    'area' => 'F-7/2',
                    'has_papers' => false,
                    'vaccinated' => false,
                    'dewormed' => false,
                    'health_certificate' => false,
                    'no_health_description' => true,
                    'is_featured' => false,
                    'created_minutes_ago' => 13,
                    'images' => [
                        ['path' => 'uploads/breeds/breed_1792663993_6ad9e1b9299a2.jfif', 'is_primary' => true],
                        ['path' => 'images/pets/syrian-hamster-golden.jpg', 'is_primary' => false],
                    ],
                ],
            ],

            // Breed: teddy-goat (Farm Animals)
            'teddy-goat' => [
                [
                    'title' => 'Handsome Pure White Teddy Bakra Kid',
                    'slug' => 'handsome-pure-white-teddy-bakra-kid',
                    'description' => "Charming pure white Teddy Bakra male with erect ears and lively personality. 5 months old, sound bone structure, raised on mother milk and top quality feed. Fully dewormed and vaccinated. Ideal for home pet breeding or farm raising.",
                    'price' => 32000,
                    'is_negotiable' => false,
                    'age_months' => 5,
                    'gender' => 'male',
                    'color' => 'Pure White with Dark Points',
                    'city' => 'Multan',
                    'area' => 'Bosan Road',
                    'has_papers' => false,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => true,
                    'no_health_description' => false,
                    'is_featured' => true,
                    'created_minutes_ago' => 35,
                    'images' => [
                        ['path' => 'uploads/breeds/breed_1792664261_6ad9e2c5e5754.png', 'is_primary' => true],
                        ['path' => 'images/pets/teddy-goat-farm.jpg', 'is_primary' => false],
                    ],
                ],
                [
                    'title' => 'Spotted Baby Teddy Goat Female (Teddy Bakri)',
                    'slug' => 'spotted-baby-teddy-goat-female-teddy-bakri',
                    'description' => "Purebred Pakistani Teddy Goat female kid, 4 months old. Active, playful, and healthy with glossy spotted brown and white fur. Grazing on green fodder, hay, and dry ration. Raised on a clean organic dairy farm. Vaccinated against PPR and Enterotoxemia.",
                    'price' => 26000,
                    'is_negotiable' => true,
                    'age_months' => 4,
                    'gender' => 'female',
                    'color' => 'Brown & White Spotted',
                    'city' => 'Faisalabad',
                    'area' => 'Jaranwala Road',
                    'has_papers' => false,
                    'vaccinated' => true,
                    'dewormed' => true,
                    'health_certificate' => true,
                    'no_health_description' => false,
                    'is_featured' => false,
                    'created_minutes_ago' => 5,
                    'images' => [
                        ['path' => 'images/pets/teddy-goat-farm.jpg', 'is_primary' => true],
                        ['path' => 'uploads/breeds/breed_1792664261_6ad9e2c5e5754.png', 'is_primary' => false],
                    ],
                ],
            ],
        ];

        // 5. Loop through all breeds and seed listings with accurate breed images
        $allBreeds = Breed::with('category')->get();

        foreach ($allBreeds as $breed) {
            $cat = $breed->category;
            $slugKey = $breed->slug;

            $listingsToSeed = isset($breedListingsData[$slugKey]) 
                ? $breedListingsData[$slugKey] 
                : null;

            // Dynamic fallback for any other newly created breeds
            if (!$listingsToSeed) {
                $breedImg = !empty($breed->image) && file_exists(public_path($breed->image))
                    ? $breed->image
                    : ($cat && !empty($cat->image) ? $cat->image : 'images/pets/german-shepherd.jpg');

                $listingsToSeed = [
                    [
                        'title' => "Purebred {$breed->name} for Sale",
                        'slug' => Str::slug("purebred-{$breed->name}-for-sale"),
                        'description' => "Healthy, active, and well-groomed {$breed->name}. Raised with care in a hygienic home environment. Eating quality diet, playful and friendly.",
                        'price' => 25000,
                        'is_negotiable' => true,
                        'age_months' => 6,
                        'gender' => 'male',
                        'color' => 'Standard',
                        'city' => 'Lahore',
                        'area' => 'DHA',
                        'has_papers' => false,
                        'vaccinated' => true,
                        'dewormed' => true,
                        'health_certificate' => false,
                        'no_health_description' => false,
                        'is_featured' => false,
                        'created_minutes_ago' => 20,
                        'images' => [
                            ['path' => $breedImg, 'is_primary' => true],
                        ],
                    ],
                    [
                        'title' => "Healthy {$breed->name} Pet",
                        'slug' => Str::slug("healthy-{$breed->name}-pet"),
                        'description' => "Affectionate and active {$breed->name}. Fully vet checked and ready for a loving new home. Contact for more details.",
                        'price' => 30000,
                        'is_negotiable' => false,
                        'age_months' => 8,
                        'gender' => 'female',
                        'color' => 'Standard',
                        'city' => 'Islamabad',
                        'area' => 'F-8',
                        'has_papers' => false,
                        'vaccinated' => true,
                        'dewormed' => true,
                        'health_certificate' => false,
                        'no_health_description' => false,
                        'is_featured' => false,
                        'created_minutes_ago' => 25,
                        'images' => [
                            ['path' => $breedImg, 'is_primary' => true],
                        ],
                    ],
                ];
            }

            foreach ($listingsToSeed as $index => $itemData) {
                $images = $itemData['images'] ?? [];
                unset($itemData['images']);

                $minutesAgo = $itemData['created_minutes_ago'] ?? 10;
                unset($itemData['created_minutes_ago']);

                $assignedUser = ($index % 2 === 0) ? $seller : $sellerAlt;

                $itemData['user_id'] = $assignedUser->id;
                $itemData['category_id'] = $cat ? $cat->id : null;
                $itemData['breed_id'] = $breed->id;
                $itemData['breed_name'] = $breed->name;
                $itemData['status'] = 'live';
                $itemData['views_count'] = rand(35, 280);
                $itemData['created_at'] = now()->subMinutes($minutesAgo);
                $itemData['updated_at'] = now()->subMinutes($minutesAgo);

                $listing = Listing::updateOrCreate(
                    ['slug' => $itemData['slug']],
                    $itemData
                );

                // Add or update images with authentic breed photos
                if (!empty($images)) {
                    ListingImage::where('listing_id', $listing->id)->delete();

                    foreach ($images as $imgIdx => $imgData) {
                        ListingImage::create([
                            'listing_id' => $listing->id,
                            'image_path' => $imgData['path'],
                            'is_primary' => !empty($imgData['is_primary']),
                            'sort_order' => $imgIdx,
                        ]);
                    }
                }
            }
        }

        // 6. Flush all home and category caches so UI updates immediately
        Cache::flush();
    }
}
