<?php

namespace App\Models;

use App\Helpers\AssetHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image', 'published_at', 'seo_title', 'seo_description',
    ];

    protected $dates = ['published_at'];

    /**
     * Ensure published_at is always cast to a DateTime (Carbon) instance.
     * This helps templates call ->format() safely.
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $appends = ['featured_image_url'];

    protected static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->slug) && ! empty($post->title)) {
                $post->slug = Str::slug($post->title) . '-' . time();
            }
        });
    }

    /**
     * Get the full URL for the featured image
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return AssetHelper::assetUrl($this->featured_image);
    }
}
