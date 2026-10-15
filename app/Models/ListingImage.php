<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'image_path',
        'thumb_path',
        'is_primary',
        'sort_order',
        'phash',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function getImageUrlAttribute(): string
    {
        $orig = ltrim((string) $this->image_path, '/\\');
        if ($orig && file_exists(public_path($orig))) {
            return asset($orig);
        }
        $thumb = ltrim((string) $this->thumb_path, '/\\');
        if ($thumb && file_exists(public_path($thumb))) {
            return asset($thumb);
        }
        if ($this->image_path) {
            return asset(ltrim((string) $this->image_path, '/\\'));
        }
        return asset('images/pets/golden-retriever.jpg');
    }
}
