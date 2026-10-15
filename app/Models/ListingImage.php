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
        if ($this->image_path && file_exists(public_path($this->image_path))) {
            return asset($this->image_path);
        }
        if ($this->thumb_path && file_exists(public_path($this->thumb_path))) {
            return asset($this->thumb_path);
        }
        return asset('images/pets/golden-retriever.jpg');
    }
}
