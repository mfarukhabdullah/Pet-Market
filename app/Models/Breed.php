<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Breed extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($breed) {
            if (empty($breed->slug)) {
                $breed->slug = Str::slug($breed->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function activeListings()
    {
        return $this->hasMany(Listing::class)->where('status', 'live');
    }
}
