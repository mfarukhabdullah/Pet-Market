<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'breed_id',
        'breed_name',
        'title',
        'slug',
        'description',
        'price',
        'is_negotiable',
        'age_months',
        'gender',
        'color',
        'has_papers',
        'vaccinated',
        'dewormed',
        'health_certificate',
        // USER PROMPT: "if some seller is selling a fish in most cases there is no health record  for fish vacination and dewormig so when user upload health description there must be option that no health desciption if user click on this there should be no description for health status of fish"
        'no_health_description',
        'city',
        'area',
        'phone_hidden',
        'status',
        'rejection_reason',
        'is_featured',
        'views_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_negotiable' => 'boolean',
        'has_papers' => 'boolean',
        'vaccinated' => 'boolean',
        'dewormed' => 'boolean',
        'health_certificate' => 'boolean',
        // USER PROMPT: "if some seller is selling a fish in most cases there is no health record  for fish vacination and dewormig so when user upload health description there must be option that no health desciption if user click on this there should be no description for health status of fish"
        'no_health_description' => 'boolean',
        'phone_hidden' => 'boolean',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
        'age_months' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($listing) {
            if (empty($listing->slug)) {
                $baseSlug = Str::slug($listing->title) ?: 'pet';
                $slug = $baseSlug;
                $counter = 2;
                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }
                $listing->slug = $slug;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function images()
    {
        return $this->hasMany(ListingImage::class)->orderBy('is_primary', 'desc')->orderBy('sort_order', 'asc');
    }

    public function primaryImage()
    {
        return $this->hasOne(ListingImage::class)->where('is_primary', true);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavoritedBy($user = null): bool
    {
        $user = $user ?: auth()->user();
        if (!$user) return false;
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /* Scopes */
    public function scopeLive($query)
    {
        return $query->where('status', 'live');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeFilter($query, array $filters)
    {
        // USER PROMPT: "yr jo pet feature ho jay to vo koi or listing main na ay"
        if (!empty($filters['featured'])) {
            $query->where('is_featured', true);
        } else {
            $query->where(function ($q) {
                $q->where('is_featured', false)->orWhereNull('is_featured');
            });
        }

        $query->when($filters['category'] ?? null, function ($q, $cat) {
            if ($cat === 'all' || empty($cat)) return;
            $categoryAliases = [
                'fish' => 'fish',
                'fishes' => 'fish',
                'reptile' => 'reptiles',
                'reptiles' => 'reptiles',
                'horse' => 'horses-farm',
                'horses' => 'horses-farm',
                'horses-farm' => 'horses-farm',
                'exotic' => 'exotic',
                'exotic-pets' => 'exotic',
            ];
            $slugs = is_string($cat) ? [$cat] : [];
            if (is_string($cat) && isset($categoryAliases[strtolower($cat)])) {
                $slugs[] = $categoryAliases[strtolower($cat)];
            }
            $q->whereHas('category', function ($sub) use ($cat, $slugs) {
                if (!empty($slugs)) {
                    $sub->whereIn('slug', $slugs)->orWhere('id', $cat);
                } else {
                    $sub->where('id', $cat);
                }
            });
        });

        $query->when($filters['breed'] ?? null, function ($q, $brd) {
            if ($brd === 'all' || trim($brd) === '') return;
            $brd = trim($brd);
            $brdClean = str_replace(['-', '_'], ' ', $brd);
            $q->where(function ($sub) use ($brd, $brdClean) {
                $sub->whereHas('breed', function ($b) use ($brd, $brdClean) {
                    $b->where('slug', $brd)
                      ->orWhere('name', 'like', "%{$brd}%")
                      ->orWhere('name', 'like', "%{$brdClean}%");
                })
                ->orWhere('breed_name', 'like', "%{$brd}%")
                ->orWhere('breed_name', 'like', "%{$brdClean}%")
                ->orWhere('title', 'like', "%{$brdClean}%");
            });
        });

        $query->when($filters['city'] ?? null, function ($q, $city) {
            if ($city !== 'all' && !empty($city)) {
                $q->where('city', 'like', "%{$city}%");
            }
        });

        $query->when(isset($filters['min_price']) && $filters['min_price'] !== null && $filters['min_price'] !== '', function ($q) use ($filters) {
            $q->where('price', '>=', (float) $filters['min_price']);
        });

        $query->when(isset($filters['max_price']) && $filters['max_price'] !== null && $filters['max_price'] !== '', function ($q) use ($filters) {
            $q->where('price', '<=', (float) $filters['max_price']);
        });

        $query->when(isset($filters['min_age_months']) && $filters['min_age_months'] !== null && $filters['min_age_months'] !== '', function ($q) use ($filters) {
            $q->where('age_months', '>=', (int) $filters['min_age_months']);
        });

        $query->when(isset($filters['max_age_months']) && $filters['max_age_months'] !== null && $filters['max_age_months'] !== '', function ($q) use ($filters) {
            $q->where('age_months', '<=', (int) $filters['max_age_months']);
        });

        $query->when($filters['vaccinated'] ?? null, function ($q) {
            $q->where('vaccinated', true);
        });

        $query->when($filters['dewormed'] ?? null, function ($q) {
            $q->where('dewormed', true);
        });

        $query->when($filters['gender'] ?? null, function ($q, $gender) {
            if (is_array($gender)) {
                $validGenders = array_filter($gender, function ($g) {
                    return $g !== 'all' && !empty($g);
                });
                if (!empty($validGenders)) {
                    $q->whereIn('gender', $validGenders);
                }
            } elseif ($gender !== 'all' && !empty($gender)) {
                if (is_string($gender) && str_contains($gender, ',')) {
                    $validGenders = array_filter(array_map('trim', explode(',', $gender)), function ($g) {
                        return $g !== 'all' && !empty($g);
                    });
                    if (!empty($validGenders)) {
                        $q->whereIn('gender', $validGenders);
                    }
                } else {
                    $q->where('gender', $gender);
                }
            }
        });

        $query->when($filters['date'] ?? null, function ($q, $date) {
            if ($date === '24h') {
                $q->where('created_at', '>=', now()->subDay());
            } elseif ($date === 'week') {
                $q->where('created_at', '>=', now()->subDays(7));
            } elseif ($date === 'month') {
                $q->where('created_at', '>=', now()->subDays(30));
            }
        });

        $query->when($filters['color'] ?? null, function ($q, $color) {
            if ($color !== 'all' && !empty($color)) {
                $q->where('color', 'like', "%{$color}%");
            }
        });

        $query->when($filters['search'] ?? null, function ($q, $term) {
            $q->where(function ($sub) use ($term) {
                $sub->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%")
                    ->orWhere('breed_name', 'like', "%{$term}%")
                    ->orWhere('color', 'like', "%{$term}%");
            });
        });

        return $query;
    }

    /* Accessors */
    public function getFormattedPriceAttribute(): string
    {
        return 'PKR ' . number_format($this->price, 0);
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        $img = $this->primaryImage ?: $this->images->first();
        if ($img) {
            $thumb = ltrim((string) $img->thumb_path, '/\\');
            if ($thumb && file_exists(public_path($thumb))) {
                return asset($thumb);
            }
            $orig = ltrim((string) $img->image_path, '/\\');
            if ($orig && file_exists(public_path($orig))) {
                return asset($orig);
            }
            if ($img->image_path) {
                return asset(ltrim((string) $img->image_path, '/\\'));
            }
        }
        return asset('images/pets/golden-retriever.jpg');
    }

    public function getAgeTextAttribute(): string
    {
        if (!$this->age_months) {
            return 'Age not specified';
        }
        if ($this->age_months >= 12) {
            $years = floor($this->age_months / 12);
            $months = $this->age_months % 12;
            return $months > 0 ? "{$years}y {$months}m" : "{$years} " . ($years > 1 ? 'years' : 'year');
        }
        return "{$this->age_months} " . ($this->age_months > 1 ? 'months' : 'month');
    }
}
