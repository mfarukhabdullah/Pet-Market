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
        'vaccinated',
        'dewormed',
        'health_certificate',
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
        'vaccinated' => 'boolean',
        'dewormed' => 'boolean',
        'health_certificate' => 'boolean',
        'phone_hidden' => 'boolean',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
        'age_months' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($listing) {
            if (empty($listing->slug)) {
                $listing->slug = Str::slug($listing->title) . '-' . Str::random(6);
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
        $query->when($filters['category'] ?? null, function ($q, $cat) {
            $q->whereHas('category', function ($sub) use ($cat) {
                $sub->where('slug', $cat)->orWhere('id', $cat);
            });
        });

        $query->when($filters['breed'] ?? null, function ($q, $brd) {
            $q->where(function ($sub) use ($brd) {
                $sub->whereHas('breed', function ($b) use ($brd) {
                    $b->where('slug', $brd)->orWhere('name', 'like', "%{$brd}%");
                })->orWhere('breed_name', 'like', "%{$brd}%");
            });
        });

        $query->when($filters['city'] ?? null, function ($q, $city) {
            if ($city !== 'all' && !empty($city)) {
                $q->where('city', 'like', "%{$city}%");
            }
        });

        $query->when($filters['min_price'] ?? null, function ($q, $min) {
            $q->where('price', '>=', (float) $min);
        });

        $query->when($filters['max_price'] ?? null, function ($q, $max) {
            $q->where('price', '<=', (float) $max);
        });

        $query->when($filters['vaccinated'] ?? null, function ($q) {
            $q->where('vaccinated', true);
        });

        $query->when($filters['dewormed'] ?? null, function ($q) {
            $q->where('dewormed', true);
        });

        $query->when($filters['gender'] ?? null, function ($q, $gender) {
            if ($gender !== 'all') {
                $q->where('gender', $gender);
            }
        });

        $query->when($filters['search'] ?? null, function ($q, $term) {
            $q->where(function ($sub) use ($term) {
                $sub->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%")
                    ->orWhere('breed_name', 'like', "%{$term}%");
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
        $img = $this->images->first();
        if ($img && $img->thumb_path) {
            return asset($img->thumb_path);
        }
        if ($img && $img->image_path) {
            return asset($img->image_path);
        }
        return asset('images/sample-pet.jpg');
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
